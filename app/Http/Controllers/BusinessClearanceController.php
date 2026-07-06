<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\BusinessClearance;
use Illuminate\Http\Request;

class BusinessClearanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $totalClearances = BusinessClearance::count();
        $todayClearances = BusinessClearance::whereDate('issued_date', today())->count();

        $monthlyClearances = BusinessClearance::whereMonth('issued_date', now()->month)
            ->whereYear('issued_date', now()->year)
            ->count();

        $totalBarangays = Barangay::count();

        $clearances = BusinessClearance::with('barangay')
            ->when($search, function ($query, $search) {
                $query->where('clearance_no', 'like', "%{$search}%")
                    ->orWhere('applicant_name', 'like', "%{$search}%")
                    ->orWhere('business_name', 'like', "%{$search}%")
                    ->orWhereHas('barangay', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10);

        return view('business_clearances.index', compact(
            'clearances',
            'search',
            'totalClearances',
            'todayClearances',
            'monthlyClearances',
            'totalBarangays'
        ));
    }

    public function create()
    {
        $barangays = Barangay::orderBy('name')->get();

        return view('business_clearances.create', compact('barangays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barangay_id' => 'required|exists:barangays,id',
            'applicant_name' => 'required|string|max:255',
            'applicant_address' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'business_type' => 'nullable|string|max:255',
            'business_address' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'issued_date' => 'required|date',
            'or_number' => 'nullable|string|max:255',
            'amount_paid' => 'nullable|numeric',
        ]);

        $last = BusinessClearance::latest()->first();

        $number = $last
            ? intval(substr($last->clearance_no, -4)) + 1
            : 1;

        $clearanceNo = 'BC-' . date('Y') . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);

        $clearance = BusinessClearance::create([
            'barangay_id' => $request->barangay_id,
            'clearance_no' => $clearanceNo,
            'applicant_name' => $request->applicant_name,
            'applicant_address' => $request->applicant_address,
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
            'business_address' => $request->business_address,
            'purpose' => $request->purpose,
            'issued_date' => $request->issued_date,
            'or_number' => $request->or_number,
            'amount_paid' => $request->amount_paid,
            'status' => 'Issued',
        ]);

        return redirect()
            ->route('business-clearances.show', $clearance->id)
            ->with('success', 'Business Clearance generated successfully.');
    }

    public function show(BusinessClearance $businessClearance)
    {
        $businessClearance->load('barangay');

        return view('business_clearances.show', compact('businessClearance'));
    }

    public function edit(BusinessClearance $businessClearance)
    {
        $barangays = Barangay::orderBy('name')->get();

        return view('business_clearances.edit', compact(
            'businessClearance',
            'barangays'
        ));
    }

    public function update(Request $request, BusinessClearance $businessClearance)
    {
        $request->validate([
            'barangay_id' => 'required|exists:barangays,id',
            'applicant_name' => 'required|string|max:255',
            'applicant_address' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'business_type' => 'nullable|string|max:255',
            'business_address' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'issued_date' => 'required|date',
            'or_number' => 'nullable|string|max:255',
            'amount_paid' => 'nullable|numeric',
        ]);

        $businessClearance->update([
            'barangay_id' => $request->barangay_id,
            'applicant_name' => $request->applicant_name,
            'applicant_address' => $request->applicant_address,
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
            'business_address' => $request->business_address,
            'purpose' => $request->purpose,
            'issued_date' => $request->issued_date,
            'or_number' => $request->or_number,
            'amount_paid' => $request->amount_paid,
        ]);

        return redirect()
            ->route('business-clearances.show', $businessClearance->id)
            ->with('success', 'Business Clearance updated successfully.');
    }

    public function destroy(BusinessClearance $businessClearance)
    {
        $businessClearance->delete();

        return redirect()
            ->route('business-clearances.index')
            ->with('success', 'Business Clearance deleted successfully.');
    }
}