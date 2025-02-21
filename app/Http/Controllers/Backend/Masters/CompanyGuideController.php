<?php

namespace App\Http\Controllers\Backend\Masters;

use App\Http\Controllers\Controller;
use App\Models\Guidelines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyGuideController extends Controller
{
    public function guidelinesForm()
    {
        return view('backend.admin.masters.company.guidelinesform');
    }

    public function viewGuidelines(Request $request)
    {
        $search = $request->input('search');
        $sortColumn = $request->input('sort', 'title'); // Default sorting column
        $sortDirection = $request->input('direction', 'asc'); // Default sorting order
        $perPage = $request->input('per_page', 10); // Default pagination length

        // Fetch guidelines based on filters
        if ($perPage == 'all') {
            $guidelines = Guidelines::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('updatedBy', 'like', "%{$search}%");
            })
                ->orderBy($sortColumn, $sortDirection)
                ->get(); // Fetch all records without pagination
        } else {
            $guidelines = Guidelines::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('updatedBy', 'like', "%{$search}%");
            })
                ->orderBy($sortColumn, $sortDirection)
                ->paginate($perPage);
        }

        return view('backend.admin.masters.company.list', compact('guidelines', 'search', 'sortColumn', 'sortDirection', 'perPage'));
    }


    public function storeGuidelines(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Renamed 'name' to 'title' as per your table
            'guidelines' => 'nullable|string', // Renamed 'description' to 'guidelines'
            'guideline_file' => 'required|file|mimes:jpeg,png,jpg,pdf,docx|max:5048' // Ensure correct file validation
        ]);

        // Create new Guideline
        $guideline = new Guidelines();
        $guideline->title = $request->name; // Corrected field name
        $guideline->guidelines = $request->description; // Corrected field name

        // Store the uploaded file if present
        if ($request->hasFile('guideline_file')) {
            $guideline->fileName = $request->file('guideline_file')->store('guidelines', 'public');
        }

        // Set updatedBy field with logged-in user ID or default to 6
        $guideline->updatedBy = auth()->user()->id ?? 6;

        $guideline->save(); // Save to database

        return redirect()->back()->with('success', 'Guideline created successfully!');
    }

    public function editGuidelines($id)
    {
        $guideline = Guidelines::findOrFail($id); // Fetch guideline by ID
        return view('backend.admin.masters.company.edit', compact('guideline'));
    }

    public function updateGuidelines(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255', // Renamed 'name' to 'title' as per your table
            'guidelines' => 'nullable|string', // Renamed 'description' to 'guidelines'
            'guideline_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf,docx|max:5048' // Ensure correct file validation
        ]);

        // Fetch guideline by ID
        $guideline = Guidelines::findOrFail($id);
        $guideline->title = $request->title; // Corrected field name
        $guideline->guidelines = $request->guidelines; // Corrected field name
        //delete the file if exists
        if ($request->hasFile('guideline_file') && Storage::disk('public')->exists($guideline->fileName)) {
            Storage::disk('public')->delete($guideline->fileName);
        }

        // Store the uploaded file if present
        if ($request->hasFile('guideline_file')) {
            $guideline->fileName = $request->file('guideline_file')->store('guidelines', 'public');
        }

        // Set updatedBy field with logged-in user ID or default to 6
        $guideline->updatedBy = auth()->user()->id ?? 6;

        $guideline->save(); // Save to database

        return redirect()->route('viewGuidelines')->with('success', 'Guideline updated successfully!');
    }
    public function deleteGuidelines($id)
    {
        $guideline = Guidelines::findOrFail($id);
        //delete the file if exists
        if (Storage::disk('public')->exists($guideline->fileName)) {
            Storage::disk('public')->delete($guideline->fileName);
        }
        $guideline->delete();
        return redirect()->back()->with('success', 'Guideline deleted successfully!');
    }
}