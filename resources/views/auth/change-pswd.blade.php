@extends('layouts.app') {{-- or your layout path --}}

@section('title', 'Change Password')

@section('content')
<div class="container-fluid py-4">

    {{-- Modern Glass Header --}}
    <div class="p-4 d-flex align-items-center mb-4 rounded-4 shadow"
         style="background: linear-gradient(to right, #00b09b, #96c93d); color: white;">
        <i class="bi bi-shield-lock-fill fs-2 me-3 text-white animate__animated animate__pulse animate__infinite"></i>
        <h3 class="mb-0 fw-bold text-white">Change Password</h3>
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg" style="backdrop-filter: blur(10px); background: rgba(255,255,255,0.1); border-radius: 1rem;">
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('admin.change-password.update') }}">
                        @csrf

                        <div class="form-floating mb-4">
                            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password" required>
                            <label for="current_password">Current Password</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
                            <label for="new_password">New Password</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Confirm New Password" required>
                            <label for="new_password_confirmation">Confirm New Password</label>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-lg px-5 rounded-4 text-white shadow"
                                style="background: linear-gradient(to right, #00b09b, #96c93d); border: none; box-shadow: 0 4px 20px rgba(0,176,155,0.4);">
                                <i class="bi bi-check-circle-fill me-2"></i> Update Password
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
