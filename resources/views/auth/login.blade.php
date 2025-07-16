<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIKOPAR</title>
    @vite('resources/css/app.css')
    <style>
        /* Custom styles for mobile responsiveness */
        @media (max-width: 800px) { /* Small screens (mobile) */
            body {
                padding: 1rem; /* Add some padding around the body */
            }
            .login-card {
                padding: 1.5rem; /* Reduced padding for the card */
                max-width: 90%; /* Ensure it takes full width on small screens */
            }
            .login-card h2 {
                font-size: 1.0rem; /* Smaller heading */
                margin-bottom: 1.0rem; /* Adjusted margin */
            }
            .error-message {
                font-size: 0.6rem; /* Smaller font for error messages */
                padding: 0.6rem 0.8rem; /* Reduced padding for error messages */
                margin-bottom: 1rem; /* Adjusted margin */
            }
            label {
                font-size: 0.5rem; /* Smaller font for labels */
                margin-bottom: 0.4rem; /* Reduced margin */
            }
            input[type="email"],
            input[type="password"] {
                padding: 0.6rem 0.8rem; /* Reduced padding for input fields */
                font-size: 0.5rem; /* Smaller font for input text */
            }
            input[type="password"] {
                margin-bottom: 0.8rem; /* Adjusted margin for password field */
            }
            button[type="submit"] {
                padding: 0.6rem 0.8rem; /* Reduced padding for button */
                font-size: 0.9rem; /* Smaller font for button text */
            }
            .mb-4-mobile { /* Custom class for smaller bottom margin on mobile */
                margin-bottom: 0.8rem;
            }
            .mb-6-mobile { /* Custom class for smaller bottom margin on mobile */
                margin-bottom: 1.2rem;
            }
        }

        /* Desktop and larger screens (min-width: 640px) - Tailwind's defaults usually handle this well */
        @media (min-width: 640px) { /* Equivalent to sm: breakpoint in Tailwind */
            body {
                padding: 0; /* Reset padding for desktop */
            }
            .login-card {
                padding: 2rem; /* Standard padding for desktop */
                max-width: 28rem; /* Tailwind's max-w-md */
            }
            .login-card h2 {
                font-size: 2rem; /* Standard heading size for desktop */
                margin-bottom: 1.5rem; /* Standard margin */
            }
            .error-message {
                font-size: 1rem; /* Standard font for error messages */
                padding: 1rem 1rem; /* Standard padding for error messages */
                margin-bottom: 1rem; /* Standard margin */
            }
            label {
                font-size: 0.875rem; /* Standard font for labels */
                margin-bottom: 0.5rem; /* Standard margin */
            }
            input[type="email"],
            input[type="password"] {
                padding: 0.5rem 0.75rem; /* Standard padding for input fields */
                font-size: 1rem; /* Standard font for input text */
            }
            input[type="password"] {
                margin-bottom: 0.75rem; /* Standard margin for password field */
            }
            button[type="submit"] {
                padding: 0.5rem 1rem; /* Standard padding for button */
                font-size: 1rem; /* Standard font for button text */
            }
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full login-card">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login SIKOPAR</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 error-message" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4 mb-4-mobile">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                              @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 mb-6-mobile">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline
                              @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>
</html>