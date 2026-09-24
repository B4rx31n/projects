<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
</head>
<body>
    <h1>Task Details</h1>
    <p><strong>Title:</strong> {{ $task->title }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Created At:</strong> {{ $task->created_at }}</p>
    <p><strong>Updated At:</strong> {{ $task->updated_at }}</p>
    <a href="{{ route('tasks.edit', $task) }}">Edit Task</a>
    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure?')">Delete Task</button>
    </form>
    <a href="{{ route('tasks.index') }}">Back to Tasks</a>
</body>
</html>
