<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIKOPAR</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Gradasi background yang menarik */
            background: linear-gradient(to right bottom, #3b82f6, #60a5fa, #93c5fd); /* Biru cerah ke biru gelap */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem; /* Tambahkan padding agar tidak terlalu mepet di mobile */
            box-sizing: border-box; /* Pastikan padding tidak menambah lebar */
        }

        .login-card {
            background-color: white;
            border-radius: 1.5rem; /* Sudut lebih melengkung */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); /* Shadow lebih halus dan nyata */
            width: 100%;
            max-width: 28rem; /* Batas lebar untuk desktop */
            padding: 2.5rem; /* Padding lebih besar */
            box-sizing: border-box;
            position: relative; /* Untuk positioning logo */
            overflow: hidden; /* Pastikan tidak ada yang keluar dari card */
        }

        .login-card h2 {
            font-size: 2.25rem; /* Ukuran lebih besar */
            color: #1f2937; /* Darker gray */
            margin-bottom: 0.5rem; /* Jarak lebih dekat ke sub-judul */
        }

        .login-card p.subtitle {
            font-size: 1rem;
            color: #6b7280; /* Medium gray */
            margin-bottom: 2rem; /* Jarak ke form */
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem; /* Jarak antar input field */
        }

        .input-group label {
            font-size: 0.9rem;
            color: #4b5563; /* Sedikit lebih gelap dari label standar */
            margin-bottom: 0.5rem;
            display: block;
        }

        .input-group input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem; /* Padding kiri untuk ikon */
            border: 1px solid #d1d5db; /* Border lebih halus */
            border-radius: 0.5rem; /* Sudut input lebih melengkung */
            font-size: 1rem;
            color: #374151; /* Darker text input */
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .input-group input:focus {
            border-color: #3b82f6; /* Warna border saat focus */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3); /* Ring focus yang lebih halus */
        }

        .input-group .icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af; /* Warna ikon */
        }

        button[type="submit"] {
            background: linear-gradient(to right, #3b82f6, #2563eb); /* Gradasi pada tombol */
            color: white;
            font-weight: 600; /* Semi-bold */
            padding: 0.8rem 1.5rem;
            border-radius: 0.75rem; /* Sudut tombol lebih melengkung */
            transition: all 0.3s ease;
            letter-spacing: 0.05em; /* Jarak antar huruf */
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3); /* Shadow tombol */
        }

        button[type="submit"]:hover {
            background: linear-gradient(to right, #2563eb, #1d4ed8); /* Gradasi saat hover */
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
            transform: translateY(-2px); /* Efek sedikit naik */
        }

        .error-message {
            background-color: #fee2e2; /* Light red */
            border-color: #ef4444; /* Red */
            color: #b91c1c; /* Darker red */
            padding: 0.8rem 1.2rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        /* Responsiveness for smaller screens */
        @media (max-width: 640px) {
            body {
                padding: 0.5rem;
            }
            .login-card {
                padding: 1.5rem;
                border-radius: 1rem;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }
            .login-card h2 {
                font-size: 1.8rem;
                margin-bottom: 0.25rem;
            }
            .login-card p.subtitle {
                font-size: 0.85rem;
                margin-bottom: 1.5rem;
            }
            .input-group {
                margin-bottom: 1rem;
            }
            .input-group label {
                font-size: 0.8rem;
                margin-bottom: 0.3rem;
            }
            .input-group input {
                padding: 0.6rem 1rem 0.6rem 2.2rem; /* Sesuaikan padding ikon */
                font-size: 0.9rem;
                border-radius: 0.4rem;
            }
            .input-group .icon {
                left: 0.6rem;
                font-size: 0.9rem;
            }
            button[type="submit"] {
                padding: 0.7rem 1.2rem;
                font-size: 0.9rem;
                border-radius: 0.6rem;
                box-shadow: 0 3px 10px rgba(59, 130, 246, 0.2);
            }
            .error-message {
                padding: 0.6rem 1rem;
                font-size: 0.8rem;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-card text-center">
        <h2 class="font-bold">Selamat Datang di SIKOPAR</h2>
        <p class="subtitle">Silakan login untuk melanjutkan.</p>

        @if ($errors->any())
            <div class="error-message" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <i class="fas fa-envelope icon"></i>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                       class="focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <i class="fas fa-lock icon"></i>
                <input type="password" id="password" name="password" required
                       class="focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-8"> <button type="submit" class="w-full">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>
</html>