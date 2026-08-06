<x-layout>
    <main>
        <p class="subtitle">{!! Illuminate\Foundation\Inspiring::quote() !!}</p>
        
        <div class="action-bar">
            <!-- Button to trigger Category modal -->
            <button class="btn-primary" id="openCategoryModalBtn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Category
            </button>

            <!-- Button to trigger Expense modal -->
            <button class="btn-primary" id="openExpenseModalBtn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Expense
            </button>
        </div>
    </main>

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
            <h2 class="modal-title">Log Expense</h2>
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
                    <div class="input-wrapper">
                        <select name="category_id" required style="width: 100%; background-color: var(--card-bg); border: 2px solid transparent; border-radius: 1rem; padding: 1.25rem 3.5rem 1.25rem 1.25rem; color: var(--text-main); font-size: 1rem; outline: none; transition: all 0.3s ease; font-family: inherit; appearance: none; cursor:pointer;">
                            <option value="" disabled selected style="color: var(--text-muted);">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                <button type="submit" class="btn-submit">Save</button>
            </form>
        </div>
    </div>

    @foreach($categories as $category)
    <p> {{ $category->name }} : ${{ number_format($category->expenses_sum_amount ?? 0, 2) }} 💰</p>
    @endforeach

    <!-- Script for modals -->
    <script>
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