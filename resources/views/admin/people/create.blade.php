@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="card shadow border-0 rounded-5 overflow-hidden" style="background-color: #f8f9fa;">

    {{-- ✅ HEADER --}}
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

          {{-- Unique ID --}}
          <div class="col-md-6">
            <label class="form-label fw-semibold text-dark">🆔 Unique ID (13 Digits)</label>
            <input type="text" name="unique_id" class="form-control form-control-lg rounded-3 shadow-sm"
              placeholder="e.g. 1234567890123"
              value="{{ old('unique_id', $user->unique_id ?? '') }}"
              pattern="\d{13}"
              maxlength="13"
              minlength="13"
              title="Enter exactly 13 digits"
              required
              oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,13)">
          </div>

          {{-- Sex --}}
          <div class="col-md-6">
            <label class="form-label fw-semibold text-dark">⚧️ Sex</label>
            <select name="gender" class="form-select form-select-lg rounded-3 shadow-sm" required>
              <option value="">Select</option>
              <option value="Male" {{ old('gender', $user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ old('gender', $user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
              <option value="Other" {{ old('gender', $user->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
          </div>

          {{-- Year --}}
          <div class="col-md-4">
            <label class="form-label fw-semibold text-dark">📅 Year</label>
            <input type="number" name="year" class="form-control form-control-lg rounded-3 shadow-sm"
              placeholder="e.g. 1975"
              value="{{ old('year', $user->year ?? '') }}" required>
          </div>

          {{-- Month --}}
          <div class="col-md-4">
            <label class="form-label fw-semibold text-dark">📅 Month</label>
            <input type="number" name="month" class="form-control form-control-lg rounded-3 shadow-sm"
              placeholder="e.g. 10"
              value="{{ old('month', $user->month ?? '') }}" required>
          </div>

          {{-- Day --}}
          <div class="col-md-4">
            <label class="form-label fw-semibold text-dark">📅 Day</label>
            <input type="number" name="day" class="form-control form-control-lg rounded-3 shadow-sm"
              placeholder="e.g. 26"
              value="{{ old('day', $user->day ?? '') }}" required>
          </div>

          {{-- County --}}
          <div class="col-md-6">
            <label class="form-label fw-semibold text-dark">📍 County</label>
            <input type="text" name="county" class="form-control form-control-lg rounded-3 shadow-sm"
              placeholder="e.g. Bucharest - District 1"
              value="{{ old('county', $user->county ?? '') }}" required>
          </div>

          {{-- Registration Code --}}
          {{-- Registration Code --}}
<div class="col-md-6">
  <label class="form-label fw-semibold text-dark">📄 Registration Code</label>
  <input type="number" name="registration_code" class="form-control form-control-lg rounded-3 shadow-sm"
    placeholder="e.g. 710"
    value="{{ old('registration_code', $user->registration_code ?? '') }}" required>
</div>

{{-- Control Code --}}
<div class="col-md-6">
  <label class="form-label fw-semibold text-dark">🔒 Control Code</label>
  <input type="number" name="control_code" class="form-control form-control-lg rounded-3 shadow-sm"
    placeholder="e.g. 0"
    value="{{ old('control_code', $user->control_code ?? '') }}" required>
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
