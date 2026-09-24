<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
</head>
<body>
    <h1>Tasks</h1>
    <a href="{{ route('tasks.create') }}">Create New Task</a>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <ul>
        @foreach($tasks as $task)
            <li>
                <strong>{{ $task->title }}</strong>
                <a href="{{ route('tasks.show', $task) }}">View</a>
                <a href="{{ route('tasks.edit', $task) }}">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
