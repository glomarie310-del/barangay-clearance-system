@extends('layouts.app')

@section('content')

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

                <div class="col-md-6">
                    <label class="form-label">Barangay</label>
                    <select name="barangay_id" id="barangay_id" class="form-select" required>
                        <option value="">Select Barangay</option>

                        @foreach($barangays as $barangay)
                            <option value="{{ $barangay->id }}"
                                data-name="{{ $barangay->name }}"
                                data-captain="{{ $barangay->captain }}"
                                data-secretary="{{ $barangay->secretary }}"
                                data-logo="{{ $barangay->logo ? asset('storage/'.$barangay->logo) : '' }}"
                                data-dryseal="{{ $barangay->dry_seal ? asset('storage/'.$barangay->dry_seal) : '' }}"
                                data-signature="{{ $barangay->captain_signature ? asset('storage/'.$barangay->captain_signature) : '' }}">
                                {{ $barangay->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date Issued</label>
                    <input type="date" name="issued_date" class="form-control"
                           value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="col-md-12">
                    <div class="alert alert-success mt-2" id="barangayPreview" style="display:none;">
                        <h5 class="fw-bold mb-3">Barangay Information Loaded</h5>

                        <div class="row">
                            <div class="col-md-4">
                                <strong>Barangay:</strong>
                                <p id="previewName">Not set</p>

                                <strong>Punong Barangay:</strong>
                                <p id="previewCaptain">Not set</p>

                                <strong>Barangay Secretary:</strong>
                                <p id="previewSecretary">Not set</p>
                            </div>

                            <div class="col-md-8">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <strong>Logo</strong><br>
                                        <img id="previewLogo" width="100" style="display:none;">
                                        <p id="noLogo" class="text-muted small">No logo uploaded</p>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Dry Seal</strong><br>
                                        <img id="previewDrySeal" width="100" style="display:none;">
                                        <p id="noDrySeal" class="text-muted small">No dry seal uploaded</p>
                                    </div>

                                    <div class="col-md-4">
                                        <strong>Signature</strong><br>
                                        <img id="previewSignature" width="140" style="display:none;">
                                        <p id="noSignature" class="text-muted small">No signature uploaded</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Applicant Name</label>
                    <input type="text" name="applicant_name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Applicant Address</label>
                    <input type="text" name="applicant_address" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Business Name</label>
                    <input type="text" name="business_name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nature of Business</label>
                    <input type="text" name="business_type" class="form-control">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Business Address</label>
                    <input type="text" name="business_address" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Purpose</label>
                    <input type="text" name="purpose" class="form-control"
                           value="Business Permit" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">OR Number</label>
                    <input type="text" name="or_number" class="form-control">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Amount Paid</label>
                    <input type="number" step="0.01" name="amount_paid" class="form-control">
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

<script>
document.getElementById('barangay_id').addEventListener('change', function () {
    let option = this.options[this.selectedIndex];

    if (!this.value) {
        document.getElementById('barangayPreview').style.display = 'none';
        return;
    }

    document.getElementById('barangayPreview').style.display = 'block';

    document.getElementById('previewName').textContent =
        option.dataset.name || 'Not set';

    document.getElementById('previewCaptain').textContent =
        option.dataset.captain || 'Not set';

    document.getElementById('previewSecretary').textContent =
        option.dataset.secretary || 'Not set';

    showImage('previewLogo', 'noLogo', option.dataset.logo);
    showImage('previewDrySeal', 'noDrySeal', option.dataset.dryseal);
    showImage('previewSignature', 'noSignature', option.dataset.signature);
});

function showImage(imageId, emptyTextId, src) {
    let img = document.getElementById(imageId);
    let emptyText = document.getElementById(emptyTextId);

    if (src) {
        img.src = src;
        img.style.display = 'inline-block';
        emptyText.style.display = 'none';
    } else {
        img.removeAttribute('src');
        img.style.display = 'none';
        emptyText.style.display = 'block';
    }
}
</script>

@endsection