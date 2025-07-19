@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="container py-5">
  <div class="card shadow border-0 rounded-5 overflow-hidden" style="background-color: #f8f9fa;">

    {{-- ✅ HEADER SAME AS CREATE PAGE --}}
    <div class="p-4 d-flex align-items-center" style="background: linear-gradient(to right, #00b09b, #96c93d); color: white;">
      <i class="bi bi-shield-lock-fill fs-3 me-3 text-white"></i>
      <h3 class="mb-0 fw-bold text-white">Change Password</h3>
    </div>

    {{-- ✅ BODY --}}
    <div class="card-body p-5 bg-white">

      {{-- Success --}}
      @if(session('success'))
        <div class="alert alert-success text-center shadow-sm rounded-3">
          {{ session('success') }}
        </div>
      @endif

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

      <form method="POST" action="{{ route('admin.change-password.update') }}" autocomplete="off">
        @csrf

        <div class="row g-4">

          {{-- 🔑 Current Password --}}
          <div class="col-md-12">
            <label class="form-label fw-semibold text-dark">🔑 Current Password</label>
            <input type="password" name="current_password" class="form-control form-control-lg rounded-3 shadow-sm"
              placeholder="Enter current password" required>
          </div>

          {{-- 🔐 New Password --}}
          <div class="col-md-6">
            <label class="form-label fw-semibold text-dark">🔐 New Password</label>
            <input type="password" name="new_password" class="form-control form-control-lg rounded-3 shadow-sm"
              placeholder="Enter new password" required>
          </div>

          {{-- ✅ Confirm Password --}}
          <div class="col-md-6">
            <label class="form-label fw-semibold text-dark">✅ Confirm New Password</label>
            <input type="password" name="new_password_confirmation" class="form-control form-control-lg rounded-3 shadow-sm"
              placeholder="Confirm new password" required>
          </div>

        </div>

        {{-- ✅ ACTION BUTTONS --}}
        <div class="d-flex justify-content-end align-items-center mt-5">
          <button type="submit" class="btn btn-lg px-5 rounded-4 text-white shadow-sm me-3"
            style="background: linear-gradient(to right, #00b09b, #96c93d); border: none;">
            <i class="bi bi-check-circle-fill me-1"></i> Update Password
          </button>

          <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark btn-lg rounded-4 shadow-sm">
            <i class="bi bi-arrow-left"></i> Back
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
