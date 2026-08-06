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
            transition: all 0.3s ease;
        }
        nav a:hover {
            color: var(--text-main);
        }
        nav a.nav-active {
            color: var(--text-main);
            text-shadow: 0 0 12px rgba(255, 255, 255, 0.6);
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
    
        main {
            padding: 4rem 2rem;
            width: 66.666%;
            margin: 0 auto;
        }
        .greeting {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .subtitle {
            color: var(--text-muted);
            font-size: 1.15rem;
            margin-bottom: 3rem;
            font-style: italic;
            letter-spacing: 0.5px;
        }
        .quote-author {
            font-weight: 600;
            font-style: normal;
            color: var(--accent-blue);
            font-size: 1rem;
            margin-left: 0.25rem;
        }
        .action-bar {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .btn-primary {
            background-color: var(--accent-blue);
            color: white;
            border: none;
            border-radius: 50%;
            width: 100px;
            height: 100px;
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 0.2rem;
            font-size: 0.85rem;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px 0 rgba(0, 102, 255, 0.39);
        }
        .btn-primary:hover {
            background-color: var(--accent-blue-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 255, 0.5);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            background-color: var(--bg-color);
            border-radius: 1.5rem;
            width: 100%;
            max-width: 450px;
            padding: 2.5rem;
            transform: translateY(20px);
            transition: all 0.3s ease;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
        }
        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }
        .modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .modal-close:hover {
            color: var(--text-main);
        }
        .modal-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }
        .input-wrapper {
            position: relative;
            width: 100%;
        }
        input {
            width: 100%;
            background-color: var(--card-bg);
            border: 2px solid transparent;
            border-radius: 1rem;
            padding: 1.25rem 3.5rem 1.25rem 1.25rem;
            color: var(--text-main);
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        input::placeholder {
            color: var(--text-muted);
        }
        input:focus {
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.15);
        }
        
        /* Custom calendar icon color adjustment */
        ::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.4;
            cursor: pointer;
            margin-right: 2rem; /* Make room for absolute icon */
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
        
        /* Tasks Stack Styles */
        .tasks-stack {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            margin-top: 3rem;
        }
        .task-card {
            background-color: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 0.75rem; /* rounded like the image */
            padding: 1.25rem 1.5rem;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 1.25rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        .task-card.task-completed .task-title {
            color: var(--text-muted);
        }
        .btn-delete {
            background-color: transparent;
            color: var(--text-muted);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-delete:hover {
            background-color: #8b0000;
            color: white;
            border-color: #8b0000;
        }
        .checkbox-empty {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 2px solid var(--text-muted);
            background-color: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }
        .checkbox-empty:hover {
            border-color: #65a30d;
            background-color: rgba(101, 163, 13, 0.1);
        }
        .checkbox-completed {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: #65a30d;
            border: 2px solid #84cc16;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            padding: 0;
            transition: all 0.3s ease;
        }
        .checkbox-completed:hover {
            background-color: #4d7c0f;
            border-color: #65a30d;
        }
        .task-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .task-title {
            font-size: 1.15rem;
            font-weight: 500;
            color: var(--text-main);
            margin: 0;
        }
        .task-desc {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.5;
            flex-grow: 1;
        }
        .task-meta {
            font-size: 0.85rem;
            color: var(--accent-blue);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-title">{{auth()->user()->name}}</div>
        <nav>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'nav-active' : '' }}">Tasks</a>
            <a href="{{ route('finance.index') }}" class="{{ request()->routeIs('finance.*') ? 'nav-active' : '' }}">Finance</a>
            <a href="{{ route('journal.index') }}" class="{{ request()->routeIs('journal.*') ? 'nav-active' : '' }}">Journal</a>
            <a href="{{ route('habits.index') }}" class="{{ request()->routeIs('habits.*') ? 'nav-active' : '' }}">Habits</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf 
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </header>

    {{ $slot }}
</body>
</html>