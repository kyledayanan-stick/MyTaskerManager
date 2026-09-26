<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0;
            color: #1f2937;
        }

        .add-btn {
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 6px;
        }

        .add-btn:hover {
            background: #1d4ed8;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .table-container {
            background: white;
            border-radius: 8px;
            overflow-x: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #1f2937;
            color: white;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        tr:hover {
            background: #f9fafb;
        }

        .pending {
            color: #b45309;
            font-weight: bold;
        }

        .completed {
            color: #15803d;
            font-weight: bold;
        }

        .edit-btn {
            background: #16a34a;
            color: white;
            padding: 7px 12px;
            border-radius: 5px;
            text-decoration: none;
        }

        .delete-btn {
            background: #dc2626;
            color: white;
            padding: 7px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #6b7280;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <h1>My Task Manager</h1>

        <a href="{{ route('tasks.create') }}" class="add-btn">
            + Add Task
        </a>

    </div>


    {{-- Success Message --}}

    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

                @forelse($tasks as $task)

                    <tr>

                        <td>
                            {{ $task->id }}
                        </td>

                        <td>
                            <strong>{{ $task->task_name }}</strong>
                        </td>

                        <td>
                            {{ $task->description ?? 'No description' }}
                        </td>

                        <td>

                            @if($task->status === 'Completed')

                                <span class="completed">
                                    Completed
                                </span>

                            @else

                                <span class="pending">
                                    Pending
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $task->due_date ?? 'No deadline' }}
                        </td>

                        <td>

                            <div class="actions">

                                <a
                                    href="{{ route('tasks.edit', $task) }}"
                                    class="edit-btn">
                                    Edit
                                </a>


                                <form
                                    action="{{ route('tasks.destroy', $task) }}"
                                    method="POST">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this task?')">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="empty">

                            No tasks found.
                            Click "Add Task" to create your first task.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>