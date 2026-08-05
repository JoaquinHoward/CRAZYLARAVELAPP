{{-- <div>
    <!--  -->
</div>
 --}}


<x-layout>
    It is never too late to be what you might have been. - George Eliot
    
    <form action="{{ route('category.store') }}" method="POST">
        @csrf

        <label>category name:</label>
        <input type="text" name="name">

        <input type="submit">
    </form>

    <form action="{{ route('expense.store') }}" method="POST">
        @csrf
        <label>expense name:</label>
        <input type="text" name="name">

        <label>amount:</label>
        <input type="number" step="0.01" name="amount" placeholder="0.00">

        <label>date:</label>
        <input type="date" name="date">
        <label>expense category: </label>
        <select name="category">
            @foreach($categories as $category)
                <option value="{{ $category->id}}"> {{ $category->name }} </option>
            @endforeach
        </select>
        <button type="submit">Save</button>
    </form>

    
</x-layout>