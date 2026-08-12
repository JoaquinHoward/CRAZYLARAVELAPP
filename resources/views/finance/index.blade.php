<x-layout>
    <main>
        <!-- Header Area -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div style="display: flex; gap: 0.5rem;">
                <button id="openCategoryModalBtn" style="border-radius: 2rem; padding: 0.5rem 1rem; font-size: 0.9rem; background-color: #24272C; color: #fff; border: 1px solid rgba(255,255,255,0.1); cursor: pointer; transition: all 0.3s ease;">
                     Category
                </button>
                <button id="openExpenseModalBtn" style="border-radius: 2rem; padding: 0.5rem 1rem; font-size: 0.9rem; background-color: #fff; color: #000; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                    add transaction
                </button> 

            </div>
        </div>

        <!-- Summary Card -->
        @php
            $totalExpenses = $categories->sum('expenses_sum_amount');
        @endphp
        <div style="display: flex; gap: 1rem; margin-bottom: 3rem;">
            <div style="background-color: #17181c; border-radius: 1.5rem; padding: 1.5rem; flex: 1; border: 1px solid rgba(255, 255, 255, 0.05);">
                <div style="display: flex; align-items: center; gap: 0.5rem; color: #888; font-size: 1rem; margin-bottom: 0.5rem; font-weight: 600;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18" style="background-color: rgba(255,255,255,0.1); border-radius: 50%; padding: 2px;" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                    Expenses
                </div>
                <div style="font-size: 2.8rem; font-weight: 700; color: #fff; letter-spacing: -1px;">
                    PHP {{ number_format($totalExpenses, 2) }}
                </div>
            </div>
        </div>

        <!-- Category Spending (Horizontal Scroll) -->
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1rem;">
            <h2 style="font-size: 1.5rem; font-weight: 600; margin: 0; color: #fff;">Budgets</h2>
        </div>

        <div style="display: flex; gap: 1rem; overflow-x: auto; padding-bottom: 1rem; scrollbar-width: none;">
            @foreach($categories as $category)
            <div style="background-color: #17181c; border-radius: 1.5rem; padding: 1.5rem; min-width: 180px; flex-shrink: 0; border: 1px solid rgba(255, 255, 255, 0.05);">
                <h3 style="font-size: 1.3rem; font-weight: 600; margin: 0 0 1.5rem 0; color: #fff;">
                    {{ $category->name }}
                </h3>
                <div style="font-size: 1.2rem; font-weight: 600; color: #fff;">
                    PHP {{ number_format($category->expenses_sum_amount ?? 0, 2) }}
                </div>
                <button onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}')" class="btn-delete" title="Edit Category" style="font-size: 1.1rem; border: none; background: transparent; outline: none;">✎</button>

            </div>

            @endforeach
            
        </div>
        
        <style>
            /* Hide scrollbar for webkit browsers */
            div::-webkit-scrollbar {
                display: none;
            }
        </style>
                <!-- Category Modal -->
        <div class="modal-overlay" id="categoryModal">
            <div class="modal-content">
                <button class="modal-close" id="closeCategoryModalBtn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <h2 class="modal-title">Create Category</h2>
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-wrapper">
                            <input type="text" name="name" placeholder="Category Name" required>
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                    </div>
                    <select name="type">
                        <option value="expense">expense</option>
                        <option value="income">income</option>
                    </select>
                    <button type="submit" class="btn-submit">Save</button>
                </form>
            </div>
        </div>

        <!-- Expense Modal -->
        <div class="modal-overlay" id="expenseModal">
            <div class="modal-content">
                <button class="modal-close" id="closeExpenseModalBtn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <h2 class="modal-title">log transaction</h2>
                <form action="{{ route('expense.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-wrapper">
                            <input type="text" name="name" placeholder="Expense Name" required>
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-wrapper">
                            <input type="number" step="0.01" name="amount" placeholder="Amount (0.00)" required>
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-wrapper">
                            <input type="date" name="date" required>
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div class="form-group">
                        <div style="display: flex; gap: 1.5rem; color: #fff;">
                            <label style="cursor: pointer;">
                                <input type="radio" name="transaction_type" value="expense" checked onchange="filterCategories()">
                                Expense
                            </label>
                            <label style="cursor: pointer;">
                                <input type="radio" name="transaction_type" value="income" onchange="filterCategories()">
                                Income
                            </label>
                        </div>
                        <div class="input-wrapper">
                            <select id="categorySelect" name="category_id" required style="width: 100%; background-color: var(--card-bg); border: 2px solid transparent; border-radius: 1rem; padding: 1.25rem 3.5rem 1.25rem 1.25rem; color: var(--text-main); font-size: 1rem; outline: none; transition: all 0.3s ease; font-family: inherit; appearance: none; cursor:pointer;">
                                <option value="" disabled selected style="color: var(--text-muted);">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" data-type="{{ $category->type }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">Save</button>
                </form>
            </div>
        </div>
        <!-- Edit Category Modal -->
        <div class="modal-overlay" id="editCategoryModal">
            <div class="modal-content">
                <button class="modal-close" onclick="document.getElementById('editCategoryModal').classList.remove('active')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <h2 class="modal-title">Edit Category</h2>
                <form id="editCategoryForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <div class="input-wrapper">
                            <input type="text" id="editCategoryNameInput" name="name" placeholder="Category Name" required>
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">Save</button>
                </form>
            </div>
        </div>

        
    </main>

    <!-- Script for modals -->
    <script>

        window.openEditModal = function(id, name) {
            document.getElementById('editCategoryForm').action = '/category/' + id;
            document.getElementById('editCategoryNameInput').value = name;
            document.getElementById('editCategoryModal').classList.add('active');
        }

        window.filterCategories = function(){
            const type = document.querySelector('input[name="transaction_type"]:checked').value;
            const options = document.querySelectorAll('#categorySelect option[data-type]');

            options.forEach(option => {
                option.hidden = (option.dataset.type !== type);
                option.disabled = (option.dataset.type !== type);
            });

            document.getElementById('categorySelect').value = "";

            
        }
        filterCategories();

        document.addEventListener('DOMContentLoaded', function() {
            function setupModal(modalId, openBtnId, closeBtnId) {
                const modal = document.getElementById(modalId);
                const openBtn = document.getElementById(openBtnId);
                const closeBtn = document.getElementById(closeBtnId);

                if(!modal || !openBtn || !closeBtn) return;

                openBtn.addEventListener('click', () => modal.classList.add('active'));
                closeBtn.addEventListener('click', () => modal.classList.remove('active'));
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) modal.classList.remove('active');
                });
                
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && modal.classList.contains('active')) {
                        modal.classList.remove('active');
                    }
                });
            }

            setupModal('categoryModal', 'openCategoryModalBtn', 'closeCategoryModalBtn');
            setupModal('expenseModal', 'openExpenseModalBtn', 'closeExpenseModalBtn');
        });
        
    </script>
</x-layout>