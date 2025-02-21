<?php

namespace App\Http\Controllers\Backend\Masters;

use App\Http\Controllers\Controller;
use App\Models\OTPRecord;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function viewOTPRecords(Request $request)
    {
        $query = OTPRecord::query();

        // Check if filtering by date range (from & to) is applied
        if ($request->has('from') && $request->has('to') && !empty($request->from) && !empty($request->to)) {
            $from = date('Y-m-d H:i:s', strtotime($request->from)); // Convert to correct format
            $to = date('Y-m-d H:i:s', strtotime($request->to));
            $query->whereBetween('cate_UpdatedDate', [$from, $to]);
        } else {
            // Default: Show today's records if no date filter is applied
            $currentDate = now()->format('Y-m-d');
            $query->whereDate('cate_UpdatedDate', $currentDate);
        }

        // Filter by mobile number if provided
        if ($request->has('mobile') && !empty($request->mobile)) {
            $query->where('Mobile_NO', 'like', '%' . $request->mobile . '%');
        }

        // Paginate results
        $otpRecords = $query->paginate(10);

        return view('backend.admin.masters.otp.list', compact('otpRecords'));
    }
}
