<?php

namespace App\Http\Controllers\Backend\Masters;

use App\Http\Controllers\Controller;
use App\Models\PackageDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PackagesController extends Controller
{
    public function packageForm()
    {
        return view('backend.admin.masters.packages.create');
    }

    public function viewPackage(Request $request)
    {
        $query = PackageDetails::query();

        // Search by package name
        if ($request->has('search') && !empty($request->search)) {
            $query->where('package_name', 'LIKE', '%' . $request->search . '%');
        }

        // Sorting
        $sortColumn = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');

        if (!in_array($sortColumn, ['package_name', 'status'])) {
            $sortColumn = 'id'; // Default sorting column
        }

        $query->orderBy($sortColumn, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 10);
        if ($perPage == 'all') {
            $packages = $query->get();
        } else {
            $packages = $query->paginate($perPage);
        }

        return view('backend.admin.masters.packages.list', compact('packages', 'sortColumn', 'sortDirection', 'perPage'));
    }
    public function index(Request $request) {}


    public function storePackage(Request $request)
    {
        Log::info($request->all());
        $request->validate([
            'package_name' => 'required|string|max:255',
            'threshold' => 'required|numeric|min:1',
            'hsn' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $package = new PackageDetails();
        $package->package_name = $request->package_name;
        $package->package_thrashold = $request->threshold;
        $package->package_descript = $request->description;
        $package->status = 'Y';
        $package->HSN = $request->hsn;
        $package->save();



        return redirect()->route('viewPackage')->with('success', 'Package created successfully!');
    }
    public function edit($package)
    {
        $package = PackageDetails::find($package);


        return view('backend.admin.masters.packages.edit', compact('package'));
    }
    public function update(Request $request, $package)
    {

        $request->validate([
            'package_name' => 'required|string|max:500',
            'package_thrashold' => 'required|string|max:100',
            'package_descript' => 'nullable|string',
            'status' => 'required|integer',
            'HSN' => 'required|string|max:200',
        ]);
        $package = PackageDetails::find($package);

        Log::info($request->all());
        Log::info($package);

        $package->update($request->all());

        return redirect()->route('viewPackage')->with('success', 'Package updated successfully!');
    }
    public function destroy($package)
    {
        $package = PackageDetails::find($package);
        $package->delete();

        return redirect()->route('viewPackage')->with('success', 'Package deleted successfully!');
    }
    public function toggleStatus($id)
    {
        Log::info($id);
        $packages = PackageDetails::find($id);
        Log::info($packages);
        $packages->status = $packages->status == 1 ? 'N' : 'Y';;
        $packages->save();

        return redirect()->route('viewPackage')->with('success', 'Package status updated successfully!');
    }
}