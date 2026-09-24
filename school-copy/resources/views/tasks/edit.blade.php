<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $task->title }}" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ $task->description }}</textarea>
        <br>
        <button type="submit">Update Task</button>
    </form>
    <a href="{{ route('tasks.show', $task) }}">Back to Task</a>
    <a href="{{ route('tasks.index') }}">Back to Tasks</a>
</body>
</html>
