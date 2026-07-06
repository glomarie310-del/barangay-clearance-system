<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;

class BarangayController extends Controller
{
    public function index()
    {
        $barangays = Barangay::orderBy('name')->paginate(10);

        return view('barangays.index', compact('barangays'));
    }

    public function create()
    {
        return redirect()->route('barangays.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('barangays.index');
    }

    public function show(Barangay $barangay)
    {
        return view('barangays.show', compact('barangay'));
    }

    public function edit(Barangay $barangay)
    {
        return view('barangays.edit', compact('barangay'));
    }

    public function update(Request $request, Barangay $barangay)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'contact_no' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'captain' => 'nullable|string|max:255',
        'secretary' => 'nullable|string|max:255',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'dry_seal' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'captain_signature' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = [
        'name' => $request->name,
        'address' => $request->address,
        'contact_no' => $request->contact_no,
        'email' => $request->email,
        'captain' => $request->captain,
        'secretary' => $request->secretary,
    ];

    if ($request->hasFile('logo')) {
        $data['logo'] = $request->file('logo')->store('barangays/logos', 'public');
    }

    if ($request->hasFile('dry_seal')) {
        $data['dry_seal'] = $request->file('dry_seal')->store('barangays/dry_seals', 'public');
    }

    if ($request->hasFile('captain_signature')) {
        $data['captain_signature'] = $request->file('captain_signature')->store('barangays/signatures', 'public');
    }

    $barangay->update($data);

    return redirect()
        ->route('barangays.index')
        ->with('success', 'Barangay information updated successfully.');
}

    public function destroy(Barangay $barangay)
    {
        return redirect()
            ->route('barangays.index')
            ->with('error', 'Barangays cannot be deleted.');
    }
}