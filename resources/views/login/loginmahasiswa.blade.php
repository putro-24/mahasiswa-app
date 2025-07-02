<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    * {
      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    .container {
      display: grid;
      grid-template-columns: 1fr 2fr;
      width: 800px;
      height: 400px;
      margin: 10% auto;
      border-radius: 5px;
      transition: background 0.3s ease;
    }

    .content-holder {
      text-align: center;
      color: white;
      font-size: 14px;
      font-weight: lighter;
      letter-spacing: 2px;
      margin-top: 15%;
      padding: 50px;
    }

    .content-holder h2 {
      font-size: 34px;
      margin: 20px auto;
    }

    .dropdown {
      position: relative;
      display: inline-block;
      width: 150px;
      margin: 20px auto;
    }

    .dropdown-btn {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 6px;
      background-color: white;
      font-size: 15px;
      cursor: pointer;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      top: 110%;
      left: 0;
      right: 0;
      border-radius: 6px;
      overflow: hidden;
      z-index: 99;
    }

    .dropdown-content button {
      width: 100%;
      padding: 10px;
      border: none;
      font-size: 14px;
      cursor: pointer;
      text-align: left;
      color: white;
    }

    .admin { background-color: #e74c3c; }
    .baak { background-color: #f39c12; }
    .dosen { background-color: #3498db; }
    .mahasiswa { background-color: #2ecc71; }

    .dropdown-content button:hover {
      opacity: 0.9;
    }

    .show { display: block; }

    .box-2 {
      background-color: white;
      margin: 5px;
    }

    .login-form-container {
      text-align: center;
      margin-top: 10%;
    }

    .login-form-container h1 {
      font-size: 24px;
      padding: 20px;
    }

    .input-field {
      font-size: 14px;
      padding: 10px;
      border-radius: 7px;
      border: 1px solid rgb(168, 168, 168);
      width: 250px;
      outline: none;
      margin-bottom: 15px;
    }

    .login-button {
      font-size: 14px;
      padding: 13px;
      border-radius: 7px;
      border: none;
      width: 250px;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .error-message {
      color: #e74c3c;
      font-size: 12px;
      margin-top: 5px;
      margin-bottom: 10px;
    }

    .success-message {
      color: #2ecc71;
      font-size: 12px;
      margin-top: 5px;
      margin-bottom: 10px;
    }

    .username-placeholder {
      font-size: 12px;
      color: #666;
      margin-bottom: 5px;
    }
  </style>
</head>

<body>
  <div class="container" id="container" style="background: linear-gradient(to bottom, rgb(6, 108, 100), rgb(14, 48, 122));">
    <!-- KIRI -->
    <div class="box-1">
      <div class="content-holder">
        <h2>Hello!</h2>

        <!-- Dropdown Login Role -->
        <div class="dropdown">
          <button onclick="toggleDropdown()" class="dropdown-btn">Pilih Role</button>
          <div id="dropdownMenu" class="dropdown-content">
            <button class="admin" onclick="setRole('admin')">Admin</button>
            <button class="baak" onclick="setRole('baak')">BAAK</button>
            <button class="dosen" onclick="setRole('dosen')">Dosen</button>
            <button class="mahasiswa" onclick="setRole('mahasiswa')">Mahasiswa</button>
          </div>
        </div>
      </div>
    </div>

    <!-- KANAN -->
    <div class="box-2">
      <div class="login-form-container">
        <h1 id="loginTitle">Pilih Role Terlebih Dahulu</h1>
        
        @if($errors->any())
          <div class="error-message">
            @foreach($errors->all() as $error)
              {{ $error }}<br>
            @endforeach
          </div>
        @endif

        @if(session('success'))
          <div class="success-message">
            {{ session('success') }}
          </div>
        @endif

        <form action="{{ route('login.authenticate') }}" method="POST" id="loginForm">
          @csrf
          <div class="username-placeholder" id="usernamePlaceholder" style="display: none;">
            <!-- Placeholder text akan diubah via JavaScript -->
          </div>
          <input type="text" name="username" placeholder="Username" class="input-field" id="usernameField" required><br>
          <input type="password" name="password" placeholder="Password" class="input-field" required><br>
          <input type="hidden" name="role" id="roleField" value="">
          <button class="login-button" id="loginButton" type="submit" disabled>Pilih Role Dulu</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    function toggleDropdown() {
      document.getElementById("dropdownMenu").classList.toggle("show");
    }

    function setRole(role) {
      const container = document.getElementById("container");
      const button = document.getElementById("loginButton");
      const title = document.getElementById("loginTitle");
      const roleField = document.getElementById("roleField");
      const usernameField = document.getElementById("usernameField");
      const usernamePlaceholder = document.getElementById("usernamePlaceholder");

      // Set role value
      roleField.value = role;
      
      // Enable login button
      button.disabled = false;

      // Update placeholder dan instruksi berdasarkan role
      switch (role.toLowerCase()) {
        case 'admin':
          container.style.background = 'linear-gradient(to bottom, #e74c3c, #c0392b)';
          button.style.backgroundColor = '#e74c3c';
          title.innerText = "Login Admin";
          usernameField.placeholder = "Email Admin";
          usernamePlaceholder.innerText = "Gunakan email untuk login";
          button.innerText = "Login Admin";
          break;
        case 'baak':
          container.style.background = 'linear-gradient(to bottom, #f39c12, #d35400)';
          button.style.backgroundColor = '#f39c12';
          title.innerText = "Login BAAK";
          usernameField.placeholder = "Email BAAK";
          usernamePlaceholder.innerText = "Gunakan email untuk login";
          button.innerText = "Login BAAK";
          break;
        case 'dosen':
          container.style.background = 'linear-gradient(to bottom, #3498db, #2c3e50)';
          button.style.backgroundColor = '#3498db';
          title.innerText = "Login Dosen";
          usernameField.placeholder = "NIM/NIDN Dosen";
          usernamePlaceholder.innerText = "Gunakan NIM/NIDN untuk login";
          button.innerText = "Login Dosen";
          break;
        case 'mahasiswa':
          container.style.background = 'linear-gradient(to bottom, #2ecc71, #27ae60)';
          button.style.backgroundColor = '#2ecc71';
          title.innerText = "Login Mahasiswa";
          usernameField.placeholder = "NIM Mahasiswa";
          usernamePlaceholder.innerText = "Gunakan NIM untuk login";
          button.innerText = "Login Mahasiswa";
          break;
        default:
          break;
      }

      // Show username placeholder
      usernamePlaceholder.style.display = 'block';

      // Tutup dropdown
      document.getElementById("dropdownMenu").classList.remove("show");
    }

    // Tutup dropdown jika klik di luar area
    window.onclick = function (event) {
      if (!event.target.matches('.dropdown-btn')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
          const openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>
</body>

<script>
     function signup()
{
    document.querySelector(".login-form-container").style.cssText = "display: none;";
    document.querySelector(".signup-form-container").style.cssText = "display: block;";
    document.querySelector(".container").style.cssText = "background: linear-gradient(to bottom, rgb(56, 189, 149),  rgb(28, 139, 106));";
    document.querySelector(".button-1").style.cssText = "display: none";
    document.querySelector(".button-2").style.cssText = "display: block";

};

function login()
{
    document.querySelector(".signup-form-container").style.cssText = "display: none;";
    document.querySelector(".login-form-container").style.cssText = "display: block;";
    document.querySelector(".container").style.cssText = "background: linear-gradient(to bottom, rgb(6, 108, 224),  rgb(14, 48, 122));";
    document.querySelector(".button-2").style.cssText = "display: none";
    document.querySelector(".button-1").style.cssText = "display: block";

}

</script>