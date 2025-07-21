@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="card shadow border-0 rounded-5 overflow-hidden">

    {{-- ✅ HEADER --}}
    <div class="p-4 d-flex align-items-center"
         style="background: linear-gradient(to right, #00b09b, #96c93d); color: white;">
      <i class="bi bi-people-fill fs-3 me-3 text-white"></i>
      <h3 class="mb-0 fw-bold text-white">People List</h3>
    </div>

    {{-- ✅ BODY --}}
    <div class="card-body bg-white p-5">

      {{-- Real-time Search --}}
      <div class="row mb-4">
  <div class="col-md-6">
    <input type="text" id="searchInput" class="form-control form-control-lg rounded-3 shadow-sm"
           placeholder="🔍 Search by county...">
  </div>
</div>

      {{-- Success Message --}}
      @if(session('success'))
        <div class="alert alert-success rounded-3 shadow-sm">{{ session('success') }}</div>
      @endif

      {{-- Table --}}
      @if($people->count())
        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle text-center" id="peopleTable">
            <thead class="table-light">
              <tr>
                <th>#</th>
                
                <th>Unique ID</th>
                <th>Gender</th>
                <th>Year</th>
                <th>Month</th>
                <th>Day</th>
                <th>County</th>
                <th>Reg Code</th>
                <th>Control Code</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($people as $index => $person)
              <tr>
                <td>{{ $index + 1 }}</td>
                
                <td class="person-id">{{ $person->unique_id }}</td>
                <td>{{ $person->gender }}</td>
                <td>{{ $person->year }}</td>
                <td>{{ $person->month }}</td>
                <td>{{ $person->day }}</td>
                <td class="person-county">{{ $person->county }}</td>
                <td>{{ $person->registration_code }}</td>
                <td>{{ $person->control_code }}</td>
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

      {{-- ✅ Add New Person Button --}}
      <div class="text-end mt-4">
        <a href="{{ route('admin.people.create') }}" class="btn btn-success btn-lg shadow-sm rounded-3">
          <i class="bi bi-person-plus-fill me-1"></i> Add New Person
        </a>
      </div>

    </div>
  </div>
</div>

{{-- ✅ JS for Live Search --}}
<script>
  document.getElementById("searchInput").addEventListener("keyup", function () {
    const input = this.value.toLowerCase();
    const rows = document.querySelectorAll("#peopleTable tbody tr");

    rows.forEach(row => {
      const county = row.querySelector(".person-county").textContent.toLowerCase();
      row.style.display = county.includes(input) ? "" : "none";
    });
  });
</script>
@endsection
