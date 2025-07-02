<head>
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

    /* Dropdown Sign Up */
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
          <button onclick="toggleDropdown()" class="dropdown-btn">Login </button>
          <div id="dropdownMenu" class="dropdown-content">
            <button class="admin" onclick="setRole('Admin')">Admin</button>
            <button class="baak" onclick="setRole('BAAK')">BAAK</button>
            <button class="dosen" onclick="setRole('Dosen')">Dosen</button>
            <button class="mahasiswa" onclick="setRole('Mahasiswa')">Mahasiswa</button>
          </div>
        </div>
      </div>
    </div>

    <!-- KANAN -->
    <div class="box-2">
      <div class="login-form-container">
        <h1 id="loginTitle">Login Form</h1>
        <input type="text" placeholder="Username" class="input-field"><br>
        <input type="password" placeholder="Password" class="input-field"><br>
        <button class="login-button" id="loginButton" type="button">Login</button>
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

      // Ubah tampilan dan warna berdasarkan role
      switch (role.toLowerCase()) {
        case 'admin':
          container.style.background = 'linear-gradient(to bottom, #e74c3c, #c0392b)';
          button.style.backgroundColor = '#e74c3c';
          title.innerText = "Login Admin";
          break;
        case 'baak':
          container.style.background = 'linear-gradient(to bottom, #f39c12, #d35400)';
          button.style.backgroundColor = '#f39c12';
          title.innerText = "Login BAAK";
          break;
        case 'dosen':
          container.style.background = 'linear-gradient(to bottom, #3498db, #2c3e50)';
          button.style.backgroundColor = '#3498db';
          title.innerText = "Login Dosen";
          break;
        case 'mahasiswa':
          container.style.background = 'linear-gradient(to bottom, #2ecc71, #27ae60)';
          button.style.backgroundColor = '#2ecc71';
          title.innerText = "Login Mahasiswa";
          break;
        default:
          break;
      }

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