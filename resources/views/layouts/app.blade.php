<!DOCTYPE html>
<html>
<head>
    <title>Task Management</title>
    <link href="/css/styles.css" rel="stylesheet">
</head>
<body>

    <nav>
        <ul>
            <li><a href="{{ route('tasks.index') }}">Home</a></li>
            <li><a href="{{ route('tasks.create') }}">Create Task</a></li>
        </ul>
    </nav>

    <div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('content')
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>
