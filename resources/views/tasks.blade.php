<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task List</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      max-width: 720px;
      margin: 0 auto;
      padding: 40px 24px;
      font-family: Arial, sans-serif;
      color: #1f2937;
      background: #f3f4f6;
    }

    h1,
    h2 {
      color: #111827;
    }

    form,
    article {
      padding: 20px;
      margin-bottom: 20px;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgb(0 0 0 / 8%);
    }

    label {
      display: inline-block;
      margin-top: 12px;
      font-weight: bold;
    }

    input,
    textarea {
      width: 100%;
      margin-top: 6px;
      padding: 10px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font: inherit;
    }

    textarea {
      min-height: 100px;
      resize: vertical;
    }

    button {
      margin-top: 16px;
      padding: 10px 16px;
      border: 0;
      border-radius: 6px;
      color: #ffffff;
      background: #2563eb;
      cursor: pointer;
    }

    button:hover {
      background: #1d4ed8;
    }

    hr {
      border: 0;
      border-top: 1px solid #d1d5db;
    }
  </style>
</head>
<body>
  <h1>My Tasks</h1>

  @if (session('success'))
    <p>{{ session('success') }}</p>
  @endif

  <form action="{{ route('tasks.store') }}" method="POST">
    @csrf

    <label for="task_title">Task title:</label><br>
    <input type="text" id="task_title" name="task_title" value="{{ old('task_title') }}"><br>

    @error('task_title')
      <p>{{ $message }}</p>
    @enderror

    <label for="description">Description:</label><br>
    <textarea id="description" name="description">{{ old('description') }}</textarea><br>

    <button type="submit">Add Task</button>
  </form>

  <h2>Saved Tasks</h2>

  @forelse ($tasks as $task)
    <article>
      <h3>{{ $task->task_title }}</h3>
      <p>{{ $task->description ?: 'No description provided.' }}</p>
      <p>Status: {{ $task->completed ? 'Completed' : 'Not completed' }}</p>
    </article>
    <hr>
  @empty
    <p>No tasks have been added yet.</p>
  @endforelse
</body>
</html>
