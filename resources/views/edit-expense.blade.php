<x-layout>
    <main>
        <h2 class="greeting">Edit Task</h2>
        
        <form action="{{ route('expense.update', $task) }}" method="POST">
            @csrf 
            @method('PATCH')
            
            <div class="form-group">
                <input type="text" name="name" value="{{ $task->title }}" required>
            </div>
            <div class="form-group">
                <input type="text" name="amount" value="{{ $task->description }}">
            </div>
            <div class="form-group">
                <input type="date" name="date" value="{{ $task->due_date }}">
            </div>
            <div class="form-group">
                <input type="date" name="transaction_type" value="{{ $task->due_date }}">
            </div>
            <div class="form-group">
                <input type="date" name="category_id" value="{{ $task->due_date }}">
            </div>
            
            <button type="submit" class="btn-primary" style="border-radius: 1rem; width: 100%; height: 50px;">Save Changes</button>
        </form>
    </main>
</x-layout>