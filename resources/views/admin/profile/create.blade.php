{{-- resources/views/admin/profile/create.blade.php --}}

@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="container py-5">
  <div class="card shadow border-0 rounded-5 overflow-hidden" style="background-color: #f8f9fa;">

    {{-- HEADER --}}
    <div class="p-4 d-flex align-items-center" style="background: linear-gradient(to right, #00b09b, #96c93d); color: white;">
      <i class="bi bi-person-lines-fill fs-3 me-3 text-white"></i>
      <h3 class="mb-0 fw-bold text-white">My Profile</h3>
    </div>

    {{-- BODY --}}
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

      <form action="{{ route('admin.profile.update') }}" method="POST" autocomplete="off">
        @csrf

        <div class="row g-4">

          {{-- Name --}}
          <div class="col-md-6">
            <label for="name" class="form-label fw-semibold text-dark">👤 Name</label>
            <input
              type="text"
              name="name"
              id="name"
              class="form-control form-control-lg rounded-3 shadow-sm @error('name') is-invalid @enderror"
              value="{{ old('name', $user->name) }}"
              required
            >
          </div>

          {{-- Email --}}
          <div class="col-md-6">
            <label for="email" class="form-label fw-semibold text-dark">✉️ Email Address</label>
            <input
              type="email"
              name="email"
              id="email"
              class="form-control form-control-lg rounded-3 shadow-sm @error('email') is-invalid @enderror"
              value="{{ old('email', $user->email) }}"
              required
            >
            <div class="form-text">
              If this email is taken by another account, it will remain unchanged.
            </div>
          </div>

          {{-- New Password --}}
          <div class="col-md-6">
            <label for="password" class="form-label fw-semibold text-dark">🔒 New Password</label>
            <input
              type="password"
              name="password"
              id="password"
              class="form-control form-control-lg rounded-3 shadow-sm @error('password') is-invalid @enderror"
            >
            <div class="form-text">
              Leave blank to keep your current password.
            </div>
          </div>

          {{-- Confirm Password --}}
          <div class="col-md-6">
            <label for="password_confirmation" class="form-label fw-semibold text-dark">🔒 Confirm Password</label>
            <input
              type="password"
              name="password_confirmation"
              id="password_confirmation"
              class="form-control form-control-lg rounded-3 shadow-sm"
            >
          </div>

        </div>

        {{-- ACTION BUTTONS --}}
        <div class="d-flex justify-content-end align-items-center mt-5">
          <button type="submit" class="btn btn-lg px-5 rounded-4 text-white shadow-sm me-3"
            style="background: linear-gradient(to right, #00b09b, #96c93d); border: none;">
            <i class="bi bi-save-fill me-1"></i> Save Changes
          </button>

          <a href="{{ url()->previous() }}" class="btn btn-outline-dark btn-lg rounded-4 shadow-sm">
            <i class="bi bi-arrow-left"></i> Back
          </a>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
