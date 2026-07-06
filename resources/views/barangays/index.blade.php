@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Barangay Profile</h2>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body table-responsive">

        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Barangay</th>
                    <th>Captain</th>
                    <th>Secretary</th>
                    <th>Contact No.</th>
                    <th>Email</th>
                    <th width="160">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($barangays as $barangay)
                    <tr>
                        <td>{{ $barangay->name }}</td>
                        <td>{{ $barangay->captain ?? 'Not set' }}</td>
                        <td>{{ $barangay->secretary ?? 'Not set' }}</td>
                        <td>{{ $barangay->contact_no ?? 'N/A' }}</td>
                        <td>{{ $barangay->email ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('barangays.edit', $barangay->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <a href="{{ route('barangays.show', $barangay->id) }}"
                               class="btn btn-sm btn-info text-white">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No barangay profiles found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $barangays->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

@endsection