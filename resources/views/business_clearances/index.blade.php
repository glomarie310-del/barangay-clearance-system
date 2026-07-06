@extends('layouts.app')

@section('content')

    

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Business Clearance Records</h2>

    <a href="{{ route('business-clearances.create') }}" class="btn btn-primary">
        + New Clearance
    </a>
</div>

<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Clearances</h6>
                <h3 class="fw-bold">{{ $totalClearances }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Issued Today</h6>
                <h3 class="fw-bold">{{ $todayClearances }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">This Month</h6>
                <h3 class="fw-bold">{{ $monthlyClearances }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Barangays</h6>
                <h3 class="fw-bold">{{ $totalBarangays }}</h3>
            </div>
        </div>
    </div>

</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('business-clearances.index') }}">
            <div class="row g-2">
                <div class="col-md-10">
                    <input type="text"
                           name="search"
                           value="{{ $search ?? '' }}"
                           class="form-control"
                           placeholder="Search clearance no, applicant, business name, or barangay">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">

        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Clearance No.</th>
                    <th>Barangay</th>
                    <th>Applicant</th>
                    <th>Business Name</th>
                    <th>Date Issued</th>
                    <th>Status</th>
                    <th width="230">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($clearances as $clearance)
                    <tr>
                        <td>{{ $clearance->clearance_no }}</td>
                        <td>{{ $clearance->barangay->name ?? 'N/A' }}</td>
                        <td>{{ $clearance->applicant_name }}</td>
                        <td>{{ $clearance->business_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($clearance->issued_date)->format('M d, Y') }}</td>
                        <td>
                            <span class="badge bg-success">
                                {{ $clearance->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('business-clearances.show', $clearance->id) }}"
                               class="btn btn-sm btn-info text-white">
                                View / Print
                            </a>

                            <a href="{{ route('business-clearances.edit', $clearance->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('business-clearances.destroy', $clearance->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Delete this clearance?')">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            No business clearance records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $clearances->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

@endsection