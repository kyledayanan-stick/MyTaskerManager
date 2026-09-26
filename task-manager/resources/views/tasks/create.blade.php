<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Task</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
        }

        h1 {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            height: 120px;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .back {
            display: inline-block;
            margin-left: 10px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Add New Task</h1>

    @if($errors->any())

        <div class="error">

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    <form action="{{ route('tasks.store') }}" method="POST">

        @csrf

        <label>Task Name</label>

        <input
            type="text"
            name="task_name"
            value="{{ old('task_name') }}"
            required>


        <label>Description</label>

        <textarea name="description">{{ old('description') }}</textarea>


        <label>Status</label>

        <select name="status">

            <option value="Pending">
                Pending
            </option>

            <option value="Completed">
                Completed
            </option>

        </select>


        <label>Due Date</label>

        <input
            type="date"
            name="due_date"
            value="{{ old('due_date') }}">


        <button type="submit">
            Add Task
        </button>

        <a href="{{ route('tasks.index') }}" class="back">
            Cancel
        </a>

    </form>

</div>

</body>
</html>