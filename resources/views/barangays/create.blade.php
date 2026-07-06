@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Generate Business Clearance</h2>

        <a href="{{ route('business-clearances.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('business-clearances.store') }}" method="POST">

                @csrf

                <div class="row g-3">

                    <!-- Barangay -->

                    <div class="col-md-6">

                        <label class="form-label">Barangay</label>

                        <select
                            name="barangay_id"
                            id="barangay_id"
                            class="form-select"
                            required>

                            <option value="">Select Barangay</option>

                            @foreach($barangays as $barangay)

                                <option
                                    value="{{ $barangay->id }}"
                                    data-name="{{ $barangay->name }}"
                                    data-captain="{{ $barangay->captain }}"
                                    data-secretary="{{ $barangay->secretary }}"
                                    data-address="{{ $barangay->address }}"
                                    data-contact="{{ $barangay->contact_no }}"
                                    data-email="{{ $barangay->email }}">

                                    {{ $barangay->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Date -->

                    <div class="col-md-6">

                        <label class="form-label">Date Issued</label>

                        <input
                            type="date"
                            name="issued_date"
                            class="form-control"
                            value="{{ date('Y-m-d') }}"
                            required>

                    </div>

                    <!-- Barangay Details -->

                    <div class="col-md-12">

                        <div
                            class="alert alert-primary"
                            id="barangayInfo"
                            style="display:none;">

                            <h5 class="mb-3">
                                Selected Barangay Information
                            </h5>

                            <div class="row">

                                <div class="col-md-6">

                                    <p>
                                        <strong>Barangay:</strong><br>
                                        <span id="barangayName"></span>
                                    </p>

                                    <p>
                                        <strong>Punong Barangay:</strong><br>
                                        <span id="captainText"></span>
                                    </p>

                                    <p>
                                        <strong>Barangay Secretary:</strong><br>
                                        <span id="secretaryText"></span>
                                    </p>

                                </div>

                                <div class="col-md-6">

                                    <p>
                                        <strong>Address:</strong><br>
                                        <span id="addressText"></span>
                                    </p>

                                    <p>
                                        <strong>Contact Number:</strong><br>
                                        <span id="contactText"></span>
                                    </p>

                                    <p>
                                        <strong>Email:</strong><br>
                                        <span id="emailText"></span>
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Applicant -->

                    <div class="col-md-6">

                        <label class="form-label">
                            Applicant Name
                        </label>

                        <input
                            type="text"
                            name="applicant_name"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Applicant Address
                        </label>

                        <input
                            type="text"
                            name="applicant_address"
                            class="form-control"
                            required>

                    </div>

                    <!-- Business -->

                    <div class="col-md-6">

                        <label class="form-label">
                            Business Name
                        </label>

                        <input
                            type="text"
                            name="business_name"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Nature of Business
                        </label>

                        <input
                            type="text"
                            name="business_type"
                            class="form-control">

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Business Address
                        </label>

                        <input
                            type="text"
                            name="business_address"
                            class="form-control"
                            required>

                    </div>

                    <!-- Purpose -->

                    <div class="col-md-6">

                        <label class="form-label">
                            Purpose
                        </label>

                        <input
                            type="text"
                            name="purpose"
                            class="form-control"
                            value="Business Permit"
                            required>

                    </div>

                    <!-- OR -->

                    <div class="col-md-3">

                        <label class="form-label">
                            OR Number
                        </label>

                        <input
                            type="text"
                            name="or_number"
                            class="form-control">

                    </div>

                    <!-- Amount -->

                    <div class="col-md-3">

                        <label class="form-label">
                            Amount Paid
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="amount_paid"
                            class="form-control">

                    </div>

                </div>

                <div class="mt-4">

                    <button class="btn btn-primary">

                        Save & Generate Clearance

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

document.getElementById('barangay_id').addEventListener('change', function(){

    let option = this.options[this.selectedIndex];

    if(this.value == ""){
        document.getElementById('barangayInfo').style.display='none';
        return;
    }

    document.getElementById('barangayInfo').style.display='block';

    document.getElementById('barangayName').textContent =
        option.dataset.name || 'Not set';

    document.getElementById('captainText').textContent =
        option.dataset.captain || 'Not set';

    document.getElementById('secretaryText').textContent =
        option.dataset.secretary || 'Not set';

    document.getElementById('addressText').textContent =
        option.dataset.address || 'Not set';

    document.getElementById('contactText').textContent =
        option.dataset.contact || 'Not set';

    document.getElementById('emailText').textContent =
        option.dataset.email || 'Not set';

});

</script>

@endsection