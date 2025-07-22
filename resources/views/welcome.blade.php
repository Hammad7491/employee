<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>CNP-Landing Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
    }
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      flex-direction: column;
    }
    .container {
      max-width: 900px;
      margin-top: 20px;
      flex: 1;
    }
    .code-box {
      background-color: #fff;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .result-box {
      background-color: #e6ffed;
      border-left: 5px solid #28a745;
      padding: 20px;
      margin-top: 30px;
      border-radius: 6px;
    }
    .error-box {
      background-color: #ffe6e6;
      border-left: 5px solid #dc3545;
      padding: 20px;
      margin-top: 30px;
      border-radius: 6px;
    }
    .code-sample {
      font-family: monospace;
      background-color: #f1f1f1;
      padding: 8px 12px;
      border-radius: 4px;
      display: inline-block;
    }
    h2, h4 {
      color: #2c3e50;
    }
    .info-table td {
      padding: 8px 12px;
      border-bottom: 1px solid #dee2e6;
    }
    .info-table td:first-child {
      font-weight: 600;
    }
  </style>
</head>
<body>

  <!-- Login button top-right -->
  <div class="d-flex justify-content-end p-3">
    <a href="{{ route('loginform') }}" class="btn btn-outline-primary btn-sm">Login</a>
  </div>

  <div class="container">
    <h2 class="text-center mb-4">CNP Verification - Personal Numeric Code Validation</h2>

    <div class="code-box">
      <form method="POST" action="{{ route('search.person') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">🔍 CNP to be validated *</label>
          <input type="text"
                 name="unique_id"
                 maxlength="13"
                 class="form-control"
                 placeholder="Enter your CNP"
                 required
                 inputmode="numeric"
                 pattern="[0-9]*"
                 value="{{ old('unique_id', session('entered_cnp') ?? '') }}"
                 oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);"
          >
        </div>
        <button type="submit" class="btn btn-primary">Validate your CNP</button>
      </form>
    </div>

    @if(session('cnp_error'))
    <div class="error-box">
      <h4 class="text-danger fw-bold">The CNP must contain 13 digits!</h4>
      <table class="w-100 info-table mt-3">
        <tr><td>Sex:</td><td>{{ session('cnp_data.sex') ?? '' }}</td></tr>
        <tr><td>Year:</td><td>{{ session('cnp_data.year') ?? 0 }}</td></tr>
        <tr><td>Month:</td><td>{{ session('cnp_data.month') ?? 0 }}</td></tr>
        <tr><td>Day:</td><td>{{ session('cnp_data.day') ?? 0 }}</td></tr>
        <tr><td>County:</td><td>{{ session('cnp_data.county') ?? '' }}</td></tr>
        <tr><td>Registration code:</td><td>{{ session('cnp_data.registration_code') ?? '' }}</td></tr>
        <tr><td>Control code:</td><td>{{ session('cnp_data.control_code') ?? 0 }}</td></tr>
      </table>
    </div>
    @elseif(session('cnp_data'))
    <div class="result-box">
      <h4>The CNP is valid! ✅</h4>
      <table class="w-100 info-table mt-3">
        <tr><td>Sex:</td><td>{{ session('cnp_data.sex') }}</td></tr>
        <tr><td>Year:</td><td>{{ session('cnp_data.year') }}</td></tr>
        <tr><td>Month:</td><td>{{ session('cnp_data.month') }}</td></tr>
        <tr><td>Day:</td><td>{{ session('cnp_data.day') }}</td></tr>
        <tr><td>County:</td><td>{{ session('cnp_data.county') }}</td></tr>
        <tr><td>Registration code:</td><td>{{ session('cnp_data.registration_code') }}</td></tr>
        <tr><td>Control code:</td><td>{{ session('cnp_data.control_code') }}</td></tr>
      </table>
    </div>
    @endif

    <hr class="my-5">

    <h4>CNP Validation</h4>
    <p>
      The validation of any CNP is done by <strong>calculating the check digit</strong>. The algorithm uses:
      <code class="code-sample">279146358279</code> constant value.
    </p>
    <p>
      If the sum of the multiplication of the CNP digits with this constant modulus 11 is equal to the last digit, the CNP is valid.
    </p>
    <p class="mt-3">Example:</p>
    <div class="code-sample mb-2">299021946900</div><br>
    <div class="code-sample">279146358279</div>

    <p class="mt-4">If 775 is mod 11 == 0 → <strong>Control is valid ✅</strong></p>

    <h4 class="mt-5">What does each number in the CNP mean?</h4>
    <table class="table table-bordered mt-3">
      <tr><td>The first digit</td><td>represents the person's gender and century.</td></tr>
      <tr><td>Digits 2-3</td><td>represent the year of birth.</td></tr>
      <tr><td>Digits 4-5</td><td>represent the month of birth.</td></tr>
      <tr><td>Digits 6-7</td><td>represent the day of birth.</td></tr>
      <tr><td>Digits 8-9</td><td>represent the county of birth.</td></tr>
      <tr><td>Digits 10-12</td><td>serial code (people born same day in same county).</td></tr>
      <tr><td>Digit 13</td><td>represents the check digit.</td></tr>
    </table>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-light text-center py-3">
    © 2025 CNP Generator – Site made by 
    <a href="mailto:madi.rock7491@gmail.com" class="text-info text-decoration-none">Hammad</a>
  </footer>

</body>
</html>
