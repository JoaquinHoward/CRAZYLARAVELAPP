<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    <form action="{{ route('login') }}" method="POST">
        @csrf 
        <label>email:</label>
        <input type="text" name="email" value={{ old('email') }}>

        <label>password:</label>
        <input type="password" name="password" value="{{ old('password') }}">

        <input type="submit">
    </form>
</div>
