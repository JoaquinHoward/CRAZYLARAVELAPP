<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #111318;
            --card-bg: #24272C;
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
            overflow: hidden;
        }
        /* Background decorative elements for the hero feel */
        .bg-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0, 102, 255, 0.15) 0%, rgba(17, 19, 24, 0) 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            pointer-events: none;
        }
        .container {
            width: 100%;
            max-width: 600px;
            padding: 3rem;
            text-align: center;
            z-index: 1;
        }
        h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-main);
            letter-spacing: -0.02em;
        }
        p {
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-bottom: 3rem;
            line-height: 1.6;
            max-width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        .button-group {
            display: flex;
            gap: 1.25rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            display: inline-block;
            text-decoration: none;
            border-radius: 0; /* sharp square */
            padding: 1.25rem 2.5rem;
            font-size: 1.125rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: var(--accent-blue);
            color: white;
            box-shadow: 0 4px 14px 0 rgba(0, 102, 255, 0.39);
        }
        .btn-primary:hover {
            background-color: var(--accent-blue-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 255, 0.5);
        }
        .btn-secondary {
            background-color: var(--card-bg);
            color: var(--text-main);
            border: 2px solid transparent;
        }
        .btn-secondary:hover {
            background-color: transparent;
            border-color: var(--text-muted);
            transform: translateY(-2px);
        }
        .btn:active {
            transform: translateY(0);
        }
        
        @media (max-width: 480px) {
            h1 { font-size: 2.5rem; }
            p { font-size: 1.1rem; max-width: 100%; }
            .button-group { flex-direction: column; gap: 1rem; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>
    <div class="container">
        <h1>Welcome</h1>
        <p>Experience the modern standard. Join us today to unlock a beautiful, seamless interface.</p>
        
        <div class="button-group">
            <a href="{{ route('register') }}" class="btn btn-primary">Sign up</a>
            <a href="{{ route('login') }}" class="btn btn-secondary">Sign in</a>
        </div>
    </div>
</body>
</html>