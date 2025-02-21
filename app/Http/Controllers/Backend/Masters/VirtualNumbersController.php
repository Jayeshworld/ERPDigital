<?php

namespace App\Http\Controllers\Backend\Masters;

use App\Http\Controllers\Controller;
use App\Imports\VirtualNumbersImport;
use App\Models\VirtualRec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class VirtualNumbersController extends Controller
{
    public function create()
    {
        return view('backend.admin.masters.virtualnumber.create');
    }
    public function viewVirtualNumbers(Request $request)
    {
        $search = $request->input('search');
        $searchField = $request->input('search_field', 'Company_Name');
        $sortColumn = $request->input('sort', 'Company_Name');
        $sortDirection = $request->input('direction', 'asc');
        $perPage = $request->input('per_page', 10);

        // Fetch virtual numbers with search, sorting, and pagination
        if ($perPage == 'all') {
            $virtualNumbers = VirtualRec::when($search, function ($query) use ($search, $searchField) {
                return $query->where($searchField, 'like', "%{$search}%");
            })->orderBy($sortColumn, $sortDirection)->get();
        } else {
            $virtualNumbers = VirtualRec::when($search, function ($query) use ($search, $searchField) {
                return $query->where($searchField, 'like', "%{$search}%");
            })->orderBy($sortColumn, $sortDirection)->paginate($perPage);
        }
        return view('backend.admin.masters.virtualnumber.list', compact('virtualNumbers', 'search', 'searchField', 'sortColumn', 'sortDirection', 'perPage'));
    }
    public function edit($id)
    {
        $virtual = VirtualRec::find($id);
        return view('backend.admin.masters.virtualnumber.edit', compact('virtual'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'virtual_number' => 'required|numeric|digits:10',
            'User_Login_ID' => 'required',
            'company_name' => 'required',
            'forwarding_number' => 'required|numeric|digits:10',
            'whatsapp_number' => 'required|numeric|digits:10',
            'call_number' => 'required|numeric|digits:10',
            'orderID' => 'required',
            'status' => 'required',
        ]);

        $virtual = VirtualRec::find($id);
        $virtual->update($request->all());
        return redirect()->route('virtualnumber.view')->with('success', 'Virtual Number updated successfully');
    }
    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required|in:insert,delete',
            'input_method' => 'required|in:manual,file',

            'file' => 'nullable|file|mimes:csv,xlsx'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $action = $request->input('action');
        $inputMethod = $request->input('input_method');

        if ($inputMethod === 'manual') {
            $numbers = array_map('trim', explode(',', $request->input('virtual_numbers')));
            if (empty($numbers)) {
                return redirect()->back()->with('error', 'Please enter at least one virtual number.');
            }
            if ($action === 'insert') {
                foreach ($numbers as $number) {
                    VirtualRec::firstOrCreate([
                        'Virtual_Number' => $number,
                        'User_Login_ID' => 0,
                        'Status' => 'Available'
                    ]);
                }
            } elseif ($action === 'delete') {
                VirtualRec::whereIn('Virtual_Number', $numbers)->delete();
            }
        }

        if ($inputMethod === 'file' && $request->hasFile('file')) {
            try {
                $file = $request->file('file');
                $path = $file->store('uploads'); // Ensure the file is stored correctly

                // Log the file path
                Log::info('File uploaded to path: ' . $path);

                // Ensure the import class exists
                if (!class_exists(VirtualNumbersImport::class)) {
                    Log::error('Import class VirtualNumbersImport not found.');
                    return redirect()->back()->with('error', 'Import class not found.');
                }

                // Create the import instance
                $import = new VirtualNumbersImport($action);

                // Log the object instance
                Log::info('Import instance created:', ['import' => $import]);

                // Perform the import and catch any errors
                Excel::import($import, $path);
                if (session()->has('error')) {
                    return redirect()->back(); // Stop success message if error exists
                }
                return redirect()->back()->with('success', 'File imported successfully.');
            } catch (\Exception $e) {
                Log::error('Import failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error importing file: ' . $e->getMessage());
            }
        }
        return redirect()->back()->with('success', 'Operation completed successfully.');
    }
}
