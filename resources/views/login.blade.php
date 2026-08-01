<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #111318;
            --input-bg: #24272C;
            --text-main: #FFFFFF;
            --text-muted: #8E96A4;
            --accent-blue: #0066FF;
            --accent-blue-hover: #0052CC;
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
        }
        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }
        h1 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2.5rem;
            color: var(--text-main);
        }
        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .input-wrapper {
            position: relative;
            width: 100%;
        }
        input {
            width: 100%;
            background-color: var(--input-bg);
            border: 2px solid transparent;
            border-radius: 1rem;
            padding: 1.25rem 3.5rem 1.25rem 1.25rem;
            color: var(--text-main);
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }
        input::placeholder {
            color: var(--text-muted);
        }
        input:focus {
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.15);
        }
        .icon {
            position: absolute;
            right: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: var(--text-muted);
            pointer-events: none;
            transition: color 0.3s ease;
        }
        input:focus + .icon {
            color: var(--accent-blue);
        }
        .btn-submit {
            width: 120px;
            height: 120px;
            margin: 1.5rem auto 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--accent-blue);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 1.125rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px 0 rgba(0, 102, 255, 0.39);
        }
        .btn-submit:hover {
            background-color: var(--accent-blue-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 255, 0.5);
        }
        .btn-submit:active {
            transform: translateY(0);
        }
        .error {
            color: #ff4d4f;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: block;
            text-align: center;
            margin-bottom: 1.25rem;
        }
        .footer-link {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-muted);
            font-size: 0.95rem;
        }
        .footer-link a {
            color: var(--text-main);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .footer-link a:hover {
            color: var(--accent-blue);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sign in</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror

            <div class="form-group">
                <div class="input-wrapper">
                    <input type="email" name="email" placeholder="Email address" value="{{ old('email') }}" required>
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>

            <div class="form-group">
                <div class="input-wrapper">
                    <input type="password" name="password" placeholder="Password" required>
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
            </div>

            <button type="submit" class="btn-submit">Done</button>
        </form>
        <div class="footer-link">
            Don't have an account? <a href="{{ route('register') }}">Sign up</a>
        </div>
    </div>
</body>
</html>
