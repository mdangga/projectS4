<!-- resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to Admin Dashboard</h1>
    <p>Your role is: {{ Auth::user()->role }}</p>
    <form method="POST" action="{{ route('signout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>