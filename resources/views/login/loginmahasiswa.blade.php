<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            width: 800px;
            height: 450px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            background: white;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .box-1 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }

        .content-holder h2 {
            font-size: 36px;
            margin-bottom: 20px;
            font-weight: 300;
        }

        .content-holder p {
            font-size: 16px;
            margin-bottom: 30px;
            opacity: 0.8;
            line-height: 1.6;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            width: 200px;
        }

        .dropdown-btn {
            width: 100%;
            padding: 15px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 16px;
            cursor: pointer;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .dropdown-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 110%;
            left: 0;
            right: 0;
            border-radius: 8px;
            overflow: hidden;
            z-index: 99;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .dropdown-content button {
            width: 100%;
            padding: 15px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            text-align: left;
            color: white;
            transition: all 0.3s ease;
        }

        .admin { background-color: #e74c3c; }
        .baak { background-color: #f39c12; }
        .dosen { background-color: #3498db; }
        .mahasiswa { background-color: #2ecc71; }

        .dropdown-content button:hover {
            opacity: 0.9;
            transform: translateX(5px);
        }

        .show { display: block; }

        .box-2 {
            background: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form-container h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .input-field:focus {
            border-color: #667eea;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #667eea;
            margin-top: 20px;
        }

        .login-button:hover {
            background: #764ba2;
            transform: translateY(-2px);
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .selected-role {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                width: 90%;
                height: auto;
            }
            
            .box-1 {
                padding: 30px;
            }
            
            .box-2 {
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="container">
        <!-- KIRI -->
        <div class="box-1">
            <div class="content-holder">
                <h2>Selamat Datang!</h2>
                <p>Silakan pilih role Anda untuk melanjutkan proses login</p>

                <!-- Dropdown Login Role -->
                <div class="dropdown">
                    <button onclick="toggleDropdown()" class="dropdown-btn" id="roleButton">
                        Pilih Role...
                    </button>
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
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <h1 id="loginTitle">Login Form</h1>
                
                <form method="POST" action="{{ route('login.authenticate') }}">
                    @csrf
                    <input type="hidden" name="role" id="selectedRole" value="">
                    
                    <div class="form-group">
                        <input type="text" 
                               name="username" 
                               placeholder="Username atau Email" 
                               class="input-field" 
                               value="{{ old('username') }}"
                               required>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" 
                               name="password" 
                               placeholder="Password" 
                               class="input-field" 
                               required>
                    </div>
                    
                    <button type="submit" class="login-button" id="loginButton">
                        Login
                    </button>
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
            const roleButton = document.getElementById("roleButton");
            const selectedRole = document.getElementById("selectedRole");

            // Set nilai role yang dipilih
            selectedRole.value = role;
            roleButton.classList.add("selected-role");

            // Ubah tampilan berdasarkan role
            const roleConfigs = {
                'admin': {
                    gradient: 'linear-gradient(135deg, #e74c3c 0%, #c0392b 100%)',
                    color: '#e74c3c',
                    title: 'Login Admin'
                },
                'baak': {
                    gradient: 'linear-gradient(135deg, #f39c12 0%, #d35400 100%)',
                    color: '#f39c12',
                    title: 'Login BAAK'
                },
                'dosen': {
                    gradient: 'linear-gradient(135deg, #3498db 0%, #2980b9 100%)',
                    color: '#3498db',
                    title: 'Login Dosen'
                },
                'mahasiswa': {
                    gradient: 'linear-gradient(135deg, #2ecc71 0%, #27ae60 100%)',
                    color: '#2ecc71',
                    title: 'Login Mahasiswa'
                }
            };

            const config = roleConfigs[role];
            if (config) {
                document.querySelector('.box-1').style.background = config.gradient;
                button.style.backgroundColor = config.color;
                title.innerText = config.title;
                roleButton.innerText = config.title.replace('Login ', '');
            }

            // Tutup dropdown
            document.getElementById("dropdownMenu").classList.remove("show");
        }

        // Tutup dropdown jika klik di luar area
        window.onclick = function(event) {
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

        // Validasi sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const role = document.getElementById('selectedRole').value;
            if (!role) {
                e.preventDefault();
                alert('Silakan pilih role terlebih dahulu!');
            }
        });
    </script>
</body>
</html>