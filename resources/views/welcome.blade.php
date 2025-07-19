<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Smart Identity Lookup</title>
  <link rel="icon" href="{{ asset('asset/images/favicon/favicon.png') }}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />

  <!-- Styles -->
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Inter', sans-serif;
      background: url('{{ asset("asset/images/background/bg-6.jpg") }}') no-repeat center center / cover;
      height: 100vh;
      color: #fff;
      overflow-y: auto;
      position: relative;
    }

    .overlay {
      position: absolute; top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.75);
      z-index: 1;
    }

    .container {
      position: relative; z-index: 2;
      min-height: 100vh;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      padding: 30px; text-align: center;
    }

    .top-right {
      position: absolute; top: 25px; right: 40px; z-index: 3;
    }

    .login-btn {
      padding: 10px 25px; font-size: 1rem; font-weight: 600;
      background: transparent; color: #fff;
      border: 2px solid #fff; border-radius: 30px;
      text-decoration: none; transition: all 0.3s ease;
    }
    .login-btn:hover { background-color: #fff; color: #333; }

    .title {
      font-size: 2.8rem; font-weight: 700; margin-bottom: 15px;
    }

    .subtitle {
      font-size: 1.1rem; font-weight: 400;
      line-height: 1.6; color: #ddd;
      margin-bottom: 40px; max-width: 700px;
    }

    .input-wrapper {
      display: flex; max-width: 600px; width: 100%;
      border-radius: 12px; overflow: hidden;
      box-shadow: 0 5px 20px rgba(255, 255, 255, 0.15);
      background-color: #fff;
    }

    .input-wrapper input {
      flex: 1; padding: 16px 20px;
      font-size: 1rem; border: none; outline: none;
      background-color: #fff; color: #333;
    }

    .input-wrapper button {
      padding: 0 30px;
      background-color: #ff6a3d;
      color: #fff; border: none;
      font-weight: 600; font-size: 1rem;
      cursor: pointer; transition: all 0.3s ease;
    }

    .input-wrapper button:hover {
      background-color: #e2572e;
    }

    #errorMsg {
      color: #ffbbbb;
      margin-top: 12px;
      font-size: 0.95rem;
      display: none;
    }

    #personResult {
      margin-top: 40px;
      text-align: left;
      max-width: 600px;
      width: 100%;
      background: #fff;
      color: #333;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(255, 255, 255, 0.1);
      display: none;
    }

    #personResult h3 {
      margin-bottom: 15px;
      font-size: 1.5rem;
      color: #ff6a3d;
    }

    #personResult p {
      margin: 5px 0;
      font-size: 1rem;
    }

    @media (max-width: 600px) {
      .title { font-size: 2rem; }
      .subtitle { font-size: 0.95rem; }

      .input-wrapper {
        flex-direction: column; border-radius: 10px;
      }

      .input-wrapper input,
      .input-wrapper button {
        width: 100%; border-radius: 0;
      }

      .input-wrapper button {
        padding: 14px; border-radius: 0 0 10px 10px;
      }

      #personResult {
        font-size: 0.95rem;
      }
    }
  </style>
</head>
<body>

  <!-- 🔒 Login Button -->
  <div class="top-right">
    <a href="/login" class="login-btn">Login</a>
  </div>

  <!-- 🌫 Overlay -->
  <div class="overlay"></div>

  <!-- 🔍 Main Content -->
  <div class="container">
    <div class="title">Make The Best Landing<br />in The Market</div>
    <div class="subtitle">
      We are LeData agency, our strategists will help you set an objective and choose your tools,
      developing a plan that is custom built for your business.
    </div>

    <form id="uniqueIdForm">
      <div class="input-wrapper">
        <input type="text" id="uniqueIdInput" placeholder="Enter Your 12-Digit Unique ID" maxlength="12" required />
        <button type="submit">Search Now →</button>
      </div>
      <div id="errorMsg">Please enter exactly 12 digits.</div>
    </form>

    <div id="personResult"></div>
  </div>

  <!-- ✅ JS Script -->
  <script>
    const form = document.getElementById('uniqueIdForm');
    const input = document.getElementById('uniqueIdInput');
    const error = document.getElementById('errorMsg');
    const resultDiv = document.getElementById('personResult');

    form.addEventListener('submit', async function(e) {
      e.preventDefault();
      const uniqueId = input.value.trim();

      if (!/^\d{12}$/.test(uniqueId)) {
        error.style.display = 'block';
        resultDiv.style.display = 'none';
        return;
      }

      error.style.display = 'none';

      try {
        const response = await fetch("{{ route('search.person') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({ unique_id: uniqueId })
        });

        const data = await response.json();

        if (data.status === "success" && data.data) {
          const p = data.data;
          resultDiv.innerHTML = `
            <h3>Person Details</h3>
            <p><strong>Name:</strong> ${p.name}</p>
            <p><strong>Gender:</strong> ${p.gender}</p>
            <p><strong>Age:</strong> ${p.age}</p>
            <p><strong>Company:</strong> ${p.company}</p>
          `;
        } else {
          resultDiv.innerHTML = `
            <p style="color: #00c774; font-weight: bold; font-size: 1.3rem;">
              ✅ Verified
            </p>
          `;
        }

        resultDiv.style.display = 'block';

      } catch (error) {
        console.error("Fetch error:", error);
        resultDiv.innerHTML = `<p style="color:red;">Server error. Please try again later.</p>`;
        resultDiv.style.display = 'block';
      }
    });
  </script>

</body>
</html>
