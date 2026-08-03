<x-layout>
    <style>
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

    <main>
        <!-- Retained original text items -->
        <p class="subtitle">Well begun is half done. - Aristotle</p>

        <div class="action-bar">
            <!-- Button to trigger the modal -->
            <button class="btn-primary" id="openModalBtn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Task
            </button>
        </div>

        <div class="tasks-stack">
            @foreach ($tasks as $task)
                <div class="task-card {{ $task->is_completed ? 'task-completed' : '' }}">
                    
                    <!-- Checkbox Area (Left) -->
                    <div class="task-checkbox-area">
                        <form action="{{ route('tasks.update', $task) }}" method="POST" style="margin: 0;">
                            @csrf 
                            @method('PATCH')
                            @if($task->is_completed)
                                <button type="submit" class="checkbox-completed" title="Mark as Incomplete">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16" stroke-width="2.5" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            @else
                                <button type="submit" class="checkbox-empty" title="Mark as Completed"></button>
                            @endif
                        </form>
                    </div>

                    <!-- Task Content (Middle) -->
                    <div class="task-content">
                        <h3 class="task-title">{{ $task->title }}</h3>
                        @if($task->description)
                            <p class="task-desc">{{ $task->description }}</p>
                        @endif
                        @if($task->due_date)
                            <div class="task-meta">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Due: {{ $task->due_date }}
                            </div>
                        @endif
                    </div>

                    <!-- Delete Action (Right) -->
                    <div class="task-delete-area">
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="margin: 0;">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn-delete" title="Delete Task">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>

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
</x-layout>
