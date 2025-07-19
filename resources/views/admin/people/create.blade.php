@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="card shadow border-0 rounded-5 overflow-hidden" style="background-color: #f8f9fa;">

    {{-- ✅ HEADER: Matching Create button color --}}
    <div class="p-4 d-flex align-items-center" style="background: linear-gradient(to right, #00b09b, #96c93d); color: white;">
      <i class="bi bi-person-plus-fill fs-3 me-3 text-white"></i>
      <h3 class="mb-0 fw-bold text-white">Add Person</h3>
    </div>

    {{-- ✅ BODY --}}
    <div class="card-body p-5 bg-white">

      {{-- Validation Errors --}}
      @if($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm">
          <ul class="mb-0">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ isset($user) ? route('admin.people.update', $user) : route('admin.people.store') }}" method="POST" autocomplete="off">
        @csrf
        @if(isset($user)) @method('PUT') @endif

        <div class="row g-4">
          {{-- Full Name --}}
          <div class="col-md-6">
            <label class="form-label fw-semibold text-dark">👤 Full Name</label>
            <input type="text" name="name" class="form-control form-control-lg rounded-3 shadow-sm"
              placeholder="Enter full name"
              value="{{ old('name', $user->name ?? '') }}" required>
          </div>

          {{-- Unique ID --}}
          <div class="col-md-6">
            <label class="form-label fw-semibold text-dark">🔢 12-Digit Unique ID</label>
            <input type="text" name="unique_id"
  class="form-control form-control-lg rounded-3 shadow-sm"
  placeholder="e.g. 123456789012"
  value="{{ old('unique_id', $user->unique_id ?? '') }}"
  pattern="\d{12}"
  maxlength="12"
  minlength="12"
  title="Please enter exactly 12 digits"
  required
  oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,12)" />

          </div>

          {{-- Gender --}}
          <div class="col-md-4">
            <label class="form-label fw-semibold text-dark">⚧️ Gender</label>
            <select name="gender" class="form-select form-select-lg rounded-3 shadow-sm" required>
              <option value="">Select Gender</option>
              <option value="Male" {{ old('gender', $user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ old('gender', $user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
              <option value="Other" {{ old('gender', $user->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
          </div>

          {{-- Age --}}
          <div class="col-md-4">
            <label class="form-label fw-semibold text-dark">🎂 Age</label>
            <input type="number" name="age" min="1" class="form-control form-control-lg rounded-3 shadow-sm"
              placeholder="e.g. 28"
              value="{{ old('age', $user->age ?? '') }}" required>
          </div>

          {{-- Company Name --}}
          <div class="col-md-4">
            <label class="form-label fw-semibold text-dark">🏢 Company Name</label>
            <input type="text" name="company" class="form-control form-control-lg rounded-3 shadow-sm"
              placeholder="e.g. ABC Pvt Ltd"
              value="{{ old('company', $user->company ?? '') }}" required>
          </div>
        </div>

        {{-- ✅ ACTION BUTTONS --}}
        <div class="d-flex justify-content-end align-items-center mt-5">
          <button type="submit" class="btn btn-lg px-5 rounded-4 text-white shadow-sm me-3"
            style="background: linear-gradient(to right, #00b09b, #96c93d); border: none;">
            <i class="bi bi-check-circle-fill me-1"></i> {{ isset($user) ? 'Update' : 'Create' }}
          </button>

          <a href="{{ route('admin.people.index') }}" class="btn btn-outline-dark btn-lg rounded-4 shadow-sm">
            <i class="bi bi-arrow-left"></i> Back
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
