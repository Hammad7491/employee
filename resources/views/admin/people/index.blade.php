@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="card shadow border-0 rounded-5 overflow-hidden">

    {{-- ✅ HEADER --}}
    <div class="p-4 d-flex align-items-center justify-content-between" style="background: linear-gradient(to right, #00b09b, #96c93d); color: white;">
      <div class="d-flex align-items-center">
        <i class="bi bi-people-fill fs-3 me-3 text-white"></i>
        <h3 class="mb-0 fw-bold text-white">People List</h3>
      </div>
      <a href="{{ route('admin.people.create') }}" class="btn btn-light text-success fw-semibold rounded-3 shadow-sm">
        <i class="bi bi-person-plus-fill me-1"></i> Add New Person
      </a>
    </div>

    {{-- ✅ BODY --}}
    <div class="card-body bg-white p-5">

      {{-- Search --}}
      <form method="GET" action="{{ route('admin.people.index') }}" class="row g-3 mb-4">
        <div class="col-md-10">
          <input type="text" name="search" class="form-control form-control-lg rounded-3 shadow-sm"
                 placeholder="Search by name, unique ID, or company..."
                 value="{{ request('search') }}">
        </div>
        <div class="col-md-2 d-grid">
          <button type="submit" class="btn btn-success btn-lg shadow-sm">
            <i class="bi bi-search me-1"></i> Search
          </button>
        </div>
      </form>

      {{-- Success Message --}}
      @if(session('success'))
        <div class="alert alert-success rounded-3 shadow-sm">{{ session('success') }}</div>
      @endif

      {{-- Table --}}
      @if($people->count())
        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Unique ID</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Company</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($people as $index => $person)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $person->name }}</td>
                <td>{{ $person->unique_id }}</td>
                <td>{{ $person->gender }}</td>
                <td>{{ $person->age }}</td>
                <td>{{ $person->company }}</td>
                <td>
                  <a href="{{ route('admin.people.edit', $person->id) }}" class="btn btn-sm btn-primary rounded-pill shadow-sm">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  <form action="{{ route('admin.people.destroy', $person->id) }}"
                        method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete this person?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger rounded-pill shadow-sm">
                      <i class="bi bi-trash3-fill"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="text-muted text-center fs-5">No people found.</p>
      @endif

    </div>
  </div>
</div>
@endsection
