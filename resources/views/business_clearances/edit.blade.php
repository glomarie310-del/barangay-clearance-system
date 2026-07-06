@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Edit Business Clearance</h2>

    <a href="{{ route('business-clearances.index') }}" class="btn btn-secondary">
        Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('business-clearances.update', $businessClearance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Barangay</label>
                    <select name="barangay_id" class="form-select" required>
                        @foreach($barangays as $barangay)
                            <option value="{{ $barangay->id }}"
                                {{ $businessClearance->barangay_id == $barangay->id ? 'selected' : '' }}>
                                {{ $barangay->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date Issued</label>
                    <input type="date" name="issued_date" class="form-control"
                           value="{{ $businessClearance->issued_date }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Applicant Name</label>
                    <input type="text" name="applicant_name" class="form-control"
                           value="{{ $businessClearance->applicant_name }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Applicant Address</label>
                    <input type="text" name="applicant_address" class="form-control"
                           value="{{ $businessClearance->applicant_address }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Business Name</label>
                    <input type="text" name="business_name" class="form-control"
                           value="{{ $businessClearance->business_name }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nature of Business</label>
                    <input type="text" name="business_type" class="form-control"
                           value="{{ $businessClearance->business_type }}">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Business Address</label>
                    <input type="text" name="business_address" class="form-control"
                           value="{{ $businessClearance->business_address }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Purpose</label>
                    <input type="text" name="purpose" class="form-control"
                           value="{{ $businessClearance->purpose }}" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">OR Number</label>
                    <input type="text" name="or_number" class="form-control"
                           value="{{ $businessClearance->or_number }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Amount Paid</label>
                    <input type="number" step="0.01" name="amount_paid" class="form-control"
                           value="{{ $businessClearance->amount_paid }}">
                </div>

            </div>

            <div class="mt-4">
                <button class="btn btn-primary">
                    Update Clearance
                </button>
            </div>

        </form>

    </div>
</div>

@endsection