<?php

namespace App\Http\Controllers\Backend\Masters;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Profile;
use Illuminate\Http\Request;

class DesignationProfileController extends Controller
{
    public function createDesignation()
    {
        return view('backend.admin.masters.designation.create');
    }
    public function storeDesignation(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $designation = new Designation();
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->created_by = auth()->user()->id;
        $designation->save();
        return redirect()->route('designationView')->with('success', 'Designation created successfully');
    }
    public function viewDesignation()
    {
        $designations = Designation::all();
        return view('backend.admin.masters.designation.list', compact('designations'));
    }
    public function editDesignation($id)
    {
        $designation = Designation::find($id);
        return view('backend.admin.masters.designation.edit', compact('designation'));
    }
    public function updateDesignation(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $designation = Designation::find($id);
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->updated_by = auth()->user()->id;
        $designation->save();
        return redirect()->route('designationView')->with('success', 'Designation updated successfully');
    }
    public function deleteDesignation($id)
    {
        $designation = Designation::find($id);
        $designation->delete();
        return redirect()->route('designationView')->with('success', 'Designation deleted successfully');
    }
    public function toggleStatus($id)
    {
        $designation = Designation::find($id);
        $designation->status = !$designation->status;
        $designation->save();
        return redirect()->route('designationView')->with('success', 'Designation status updated successfully');
    }

    public function createProfile()
    {
        return view('backend.admin.masters.profile.create');
    }
    public function storeProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $profile = new Profile();
        $profile->name = $request->name;
        $profile->description = $request->description;
        $profile->created_by = auth()->user()->id;
        $profile->save();
        return redirect()->route('profileView')->with('success', 'Profile created successfully');
    }
    public function viewProfile()
    {
        $profiles = Profile::all();
        return view('backend.admin.masters.profile.list', compact('profiles'));
    }
    public function editProfile($id)
    {
        $profile = Profile::find($id);
        return view('backend.admin.masters.profile.edit', compact('profile'));
    }
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $profile = Profile::find($id);
        $profile->name = $request->name;
        $profile->description = $request->description;
        $profile->updated_by = auth()->user()->id;
        $profile->save();
        return redirect()->route('profileView')->with('success', 'Profile updated successfully');
    }
    public function deleteProfile($id)
    {
        $profile = Profile::find($id);
        $profile->delete();
        return redirect()->route('profileView')->with('success', 'Profile deleted successfully');
    }
    public function toggleProfileStatus($id)
    {
        $profile = Profile::find($id);
        $profile->status = !$profile->status;
        $profile->save();
        return redirect()->route('profileView')->with('success', 'Profile status updated successfully');
    }
}
