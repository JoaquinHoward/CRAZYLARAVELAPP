<div>
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label>name:</label>
        <input type="text" name="name">

        <label>email:</label>
        <input type="email" name="email">

        <label>password:</label>
        <input type="password" name="password">

        <label>confirm password:</label>
        <input type="password" name="password_confirmation">

        <input type="submit">
    </form>
</div>
