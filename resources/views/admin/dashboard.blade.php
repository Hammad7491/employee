@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<style>
  /* Stat Card Styles */
  .stat-card {
    border-radius: 1rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
    background: #fff;
  }
  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  }
  .stat-card-header {
    background: linear-gradient(135deg, #00b09b, #96c93d);
    color: #fff;
    padding: 1rem;
  }
  .stat-card-header h5 {
    margin: 0;
    font-weight: 600;
  }
  .stat-card-body {
    padding: 2rem;
  }
  .stat-number {
    font-size: 3rem;
  }
</style>

<div class="container py-5">

  {{-- Greeting centered --}}
  <div class="row justify-content-center mb-5">
    <div class="col-auto">
      <h2 class="fw-bold">Welcome, {{ Auth::user()->name }}</h2>
    </div>
  </div>

  {{-- Stats row --}}
  <div class="row justify-content-center g-4">

    {{-- Total People Card --}}
    <div class="col-12 col-md-6 col-lg-4">
      <div class="stat-card text-center">
        <div class="stat-card-header">
          <h5>Total People Added</h5>
        </div>
        <div class="stat-card-body">
          <div class="stat-number text-success">{{ $totalPeople }}</div>
        </div>
      </div>
    </div>

    {{-- Gender Chart Card --}}
    <div class="col-12 col-md-6 col-lg-4">
      <div class="stat-card text-center">
        <div class="stat-card-header">
          <h5>👥 People by Gender</h5>
        </div>
        <div class="stat-card-body">
          <div style="width:200px; height:200px; margin:auto;">
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
      labels: Object.keys(genderData),
      datasets: [{
        data: Object.values(genderData),
        backgroundColor: ['#007bff', '#dc3545'],
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { position: 'bottom', labels: { font: { size: 13 } } }
      }
    }
  });
</script>
@endsection
