<x-layout>
    

    <main>
        <p class="subtitle">{!! Illuminate\Foundation\Inspiring::quote() !!}</p>

        <div class="action-bar">
            <!-- Button to trigger the modal -->
            <button class="btn-primary" id="openModalBtn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Task
            </button>
        </div>

        @if($tasks->count() > 0)
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 3rem; margin-bottom: 1.5rem;">
                <h2 class="greeting" style="font-size: 1.8rem; margin: 0;">Active Tasks</h2>
                <form action="{{ route('tasks.destroyCurrent') }}" method="POST" style="margin: 0;">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" style="background-color: transparent; color: var(--text-muted); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 50%; width: 45px; height: 45px; display: inline-flex; flex-direction: column; justify-content: center; align-items: center; gap: 0.1rem; font-size: 0.65rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: none;" onmouseover="this.style.backgroundColor='#8b0000'; this.style.color='white'; this.style.borderColor='#8b0000'; this.style.boxShadow='0 4px 12px 0 rgba(139, 0, 0, 0.4)';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--text-muted)'; this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none';" title="Clear All Active Tasks">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        All
                    </button>
                </form>
            </div>
        @endif
        <div class="tasks-stack" style="margin-top: 0;">
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

                    <button onclick="openEditModal({{ $task->id }}, '{{ addslashes($task->title) }}', '{{ addslashes($task->description) }}', '{{ $task->due_date }}')" class="btn-delete" title="Edit Task" style="font-size: 1.1rem; border: none; background: transparent; outline: none;">✎</button>

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

        @if($done_tasks->count() > 0)
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 3rem; margin-bottom: 1.5rem;">
                <h2 class="greeting" style="font-size: 1.8rem; margin: 0;">Completed Tasks</h2>
                <form action="{{ route('tasks.destroyCompleted') }}" method="POST" style="margin: 0;">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" style="background-color: transparent; color: var(--text-muted); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 50%; width: 45px; height: 45px; display: inline-flex; flex-direction: column; justify-content: center; align-items: center; gap: 0.1rem; font-size: 0.65rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: none;" onmouseover="this.style.backgroundColor='#8b0000'; this.style.color='white'; this.style.borderColor='#8b0000'; this.style.boxShadow='0 4px 12px 0 rgba(139, 0, 0, 0.4)';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--text-muted)'; this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none';" title="Clear All Completed Tasks">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        All
                    </button>
                </form>
            </div>
            <div class="tasks-stack" style="margin-top: 0;">
                @foreach ($done_tasks as $task)
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

                       <button onclick="openEditModal({{ $task->id }}, '{{ addslashes($task->title) }}', '{{ addslashes($task->description) }}', '{{ $task->due_date }}')" class="btn-delete" title="Edit Task" style="font-size: 1.1rem; border: none; background: transparent; outline: none;">✎</button>


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
        @endif
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

    <!-- Edit Modal Popup Container -->
    <div class="modal-overlay" id="editTaskModal">
        <div class="modal-content">
            <button class="modal-close" id="closeEditModalBtn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <h2 class="modal-title">Edit Task</h2>
            
            <form id="editTaskForm" method="POST" action="">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="editTitle" name="title" placeholder="Title" required>
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="editDescription" name="description" placeholder="Description">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="date" id="editDueDate" name="due_date" >
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Save</button>
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
            
            // Edit Modal Logic
            const editModal = document.getElementById('editTaskModal');
            const closeEditBtn = document.getElementById('closeEditModalBtn');

            window.openEditModal = function(taskId, title, description, dueDate) {
                document.getElementById('editTaskForm').action = '/task/' + taskId;
                document.getElementById('editTitle').value = title;
                document.getElementById('editDescription').value = description || '';
                document.getElementById('editDueDate').value = dueDate || '';
                editModal.classList.add('active');
            };

            function closeEditModal() {
                editModal.classList.remove('active');
            }

            closeEditBtn.addEventListener('click', closeEditModal);

            // Close on overlay click for edit modal
            editModal.addEventListener('click', function(e) {
                if (e.target === editModal) {
                    closeEditModal();
                }
            });

            // Close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (modal.classList.contains('active')) closeModal();
                    if (editModal.classList.contains('active')) closeEditModal();
                }
            });
        });
    </script>
</x-layout>
