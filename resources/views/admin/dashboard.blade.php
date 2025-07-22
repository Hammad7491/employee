@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container py-5">
    {{-- Total People Card --}}
    <div class="row justify-content-center mb-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h4 class="fw-semibold mb-3">Total People Added</h4>
                    <div class="display-4 fw-bold text-success">{{ $totalPeople }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Gender Chart --}}
    <div class="row justify-content-center mt-4">
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="fw-bold mb-3">👥 People by Gender</h6>
                    <div style="width: 200px; height: 200px; margin: auto;">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const genderData = @json($genderStats);
    const ctx = document.getElementById('genderChart').getContext('2d');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: Object.keys(genderData), // ['Male', 'Female']
            datasets: [{
                data: Object.values(genderData), // [2, 2]
                backgroundColor: ['#007bff', '#dc3545'], // Blue, Red
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 13
                        }
                    }
                }
            }
        }
    });
</script>
@endsection

