<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $student->name }}" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $student->email }}" required>
        <br>
        <label for="class">Class:</label>
        <input type="text" name="class" id="class" value="{{ $student->class }}" required>
        <br>
        <button type="submit">Update Student</button>
    </form>
    <a href="{{ route('students.show', $student) }}">Back to Student</a>
    <a href="{{ route('students.index') }}">Back to Students</a>
</body>
</html>
