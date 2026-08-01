<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
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
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .header-title {
            font-size: 1.5rem;
            font-weight: 700;
        }
        nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        nav a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        nav a:hover {
            color: var(--text-main);
        }
        .logout-btn {
            background-color: #8b0000;
            color: white;
            border: none;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #a50000;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.4);
        }
    </style>
</head>
<body>
    <header>
        <div class="header-title">tasks</div>
        <nav>
            <a href="/dashboard" style="color: var(--text-main);">Tasks</a>
            <a href="{{ route('finance.index') }}">Finance</a>
            <a href="{{ route('journal.index') }}">Journal</a>
            <a href="{{ route('habits.index') }}">Habits</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf 
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </header>

    {{ $slot }}
</body>
</html>