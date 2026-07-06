@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Edit Barangay Information</h2>

    <a href="{{ route('barangays.index') }}" class="btn btn-secondary">
        Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('barangays.update', $barangay->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Barangay Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $barangay->name) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Contact Number</label>
                    <input type="text" name="contact_no" class="form-control"
                           value="{{ old('contact_no', $barangay->contact_no) }}">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Barangay Address</label>
                    <input type="text" name="address" class="form-control"
                           value="{{ old('address', $barangay->address) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $barangay->email) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Punong Barangay</label>
                    <input type="text" name="captain" class="form-control"
                           value="{{ old('captain', $barangay->captain) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Barangay Secretary</label>
                    <input type="text" name="secretary" class="form-control"
                           value="{{ old('secretary', $barangay->secretary) }}">
                </div>

            </div>

            <hr>

            <h5 class="fw-bold mb-3">Barangay Assets</h5>

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">Barangay Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">

                    @if($barangay->logo)
                        <img src="{{ asset('storage/'.$barangay->logo) }}"
                             width="120"
                             class="mt-2 border rounded">
                    @endif
                </div>

                <div class="col-md-4">
                    <label class="form-label">Dry Seal</label>
                    <input type="file" name="dry_seal" class="form-control" accept="image/*">

                    @if($barangay->dry_seal)
                        <img src="{{ asset('storage/'.$barangay->dry_seal) }}"
                             width="120"
                             class="mt-2 border rounded">
                    @endif
                </div>

                <div class="col-md-4">
                    <label class="form-label">Captain Signature</label>
                    <input type="file" name="captain_signature" class="form-control" accept="image/*">

                    @if($barangay->captain_signature)
                        <img src="{{ asset('storage/'.$barangay->captain_signature) }}"
                             width="180"
                             class="mt-2 border rounded">
                    @endif
                </div>

            </div>

            <hr>

            <button class="btn btn-primary">
                Update Barangay
            </button>

        </form>

    </div>
</div>

@endsection