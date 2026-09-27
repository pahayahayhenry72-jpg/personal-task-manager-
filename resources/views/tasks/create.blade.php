<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Add Task - Personal Task Manager</title>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 40px;
        min-height: 100vh;
        background: #f5f0e6;
    }

    .container {
        max-width: 650px;
        margin: auto;
    }

    .header {
        background: #174c3c;
        color: white;
        padding: 30px;
        border-radius: 16px 16px 0 0;
    }

    .header h1 {
        margin: 0 0 8px;
        font-size: 30px;
    }

    .header p {
        margin: 0;
        color: #d8eee5;
    }

    .form-box {
        background: #fffaf0;
        padding: 30px;
        border-radius: 0 0 16px 16px;
        box-shadow: 0 5px 20px rgba(40, 30, 20, 0.12);
    }

    label {
        display: block;
        color: #174c3c;
        font-weight: bold;
        margin-bottom: 7px;
    }

    input,
    textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #d8cbb8;
        border-radius: 8px;
        background: #fffdf8;
        color: #3f3327;
        font-size: 15px;
        margin-bottom: 20px;
    }

    input:focus,
    textarea:focus {
        outline: none;
        border-color: #286b54;
    }

    textarea {
        height: 130px;
        resize: vertical;
    }

    .save-button {
        background: #e8892d;
        color: white;
        border: none;
        padding: 13px 22px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    .save-button:hover {
        background: #cf711b;
    }

    .back-button {
        display: inline-block;
        margin-top: 20px;
        color: #286b54;
        text-decoration: none;
        font-weight: bold;
    }

    .back-button:hover {
        color: #174c3c;
    }

    .error {
        background: #fce4d6;
        color: #8a3b12;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .error ul {
        margin: 0;
        padding-left: 20px;
    }
</style>
```

</head>

<body>

<div class="container">

```
<div class="header">
    <h1>Add New Task</h1>
    <p>Create a task and keep your work organized.</p>
</div>

<div class="form-box">

    @if ($errors->any())

        <div class="error">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <form action="{{ route('tasks.store') }}" method="POST">

        @csrf

        <label for="task_name">
            Task Name
        </label>

        <input
            type="text"
            id="task_name"
            name="task_name"
            placeholder="Enter your task"
            value="{{ old('task_name') }}"
            required
        >

        <label for="description">
            Description
        </label>

        <textarea
            id="description"
            name="description"
            placeholder="Describe your task..."
        >{{ old('description') }}</textarea>

        <label for="due_date">
            Due Date
        </label>

        <input
            type="date"
            id="due_date"
            name="due_date"
            value="{{ old('due_date') }}"
        >

        <button type="submit" class="save-button">
            Save Task
        </button>

    </form>

    <a href="{{ route('tasks.index') }}" class="back-button">
        ← Back to Tasks
    </a>

</div>
```

</div>

</body>

</html>
