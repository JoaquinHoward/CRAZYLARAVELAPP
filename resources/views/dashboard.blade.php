<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        .logout-btn {
            background: transparent;
            color: var(--text-muted);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0.6rem 1.25rem;
            border-radius: 0;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .logout-btn:hover {
            color: var(--text-main);
            border-color: var(--text-main);
            background: rgba(255,255,255,0.05);
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
            font-size: 1.1rem;
            margin-bottom: 3rem;
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
            border-radius: 0;
            padding: 0.75rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px 0 rgba(0, 102, 255, 0.39);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
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
            width: 100%;
            background-color: var(--accent-blue);
            color: white;
            border: none;
            border-radius: 0;
            padding: 1.25rem;
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
            border-radius: 0; /* sharp square */
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .task-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        .task-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-main);
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
        <div class="header-title">Dashboard</div>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf 
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </header>

    <main>
        <!-- Retained original text items -->
        <h1 class="greeting">Welcome back!</h1>
        <p class="subtitle">What a cutie! Well begun is half done. - Aristotle</p>

        <div class="action-bar">
            <!-- Button to trigger the modal -->
            <button class="btn-primary" id="openModalBtn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Task
            </button>
        </div>

        <div class="tasks-stack">
            @foreach ($tasks as $task)
                <div class="task-card">
                    <h3 class="task-title">{{ $task->title }}</h3>
                    @if($task->description)
                        <p class="task-desc">{{ $task->description }}</p>
                    @endif
                    @if($task->due_date)
                        <div class="task-meta">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Due: {{ $task->due_date }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </main>

    <!-- Modal Popup Container -->
    <div class="modal-overlay" id="taskModal">
        <div class="modal-content">
            <button class="modal-close" id="closeModalBtn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <h2 class="modal-title">Create Task</h2>
            
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" name="title" placeholder="Title" required>
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" name="description" placeholder="Description">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="date" name="due_date" >
                        <!-- For the date field, we rely on the browser's native date picker, styled in CSS -->
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Done</button>
            </form>
        </div>
    </div>

    <!-- Modal interactivity script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('taskModal');
            const openBtn = document.getElementById('openModalBtn');
            const closeBtn = document.getElementById('closeModalBtn');

            function openModal() {
                modal.classList.add('active');
            }

            function closeModal() {
                modal.classList.remove('active');
            }

            openBtn.addEventListener('click', openModal);
            closeBtn.addEventListener('click', closeModal);

            // Close on overlay click
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
            
            // Close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.classList.contains('active')) {
                    closeModal();
                }
            });
        });
    </script>
</body>
</html>
