<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Personal Task Manager</title>

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
        max-width: 1100px;
        margin: auto;
    }

    /* HEADER */

    .header {
        background: #174c3c;
        color: white;
        padding: 30px;
        border-radius: 16px;
        margin-bottom: 25px;
    }

    .header h1 {
        margin: 0 0 8px;
        font-size: 34px;
    }

    .header p {
        margin: 0;
        color: #d8eee5;
    }

    /* DASHBOARD */

    .dashboard {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .card {
        padding: 22px;
        border-radius: 12px;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .card h3 {
        margin: 0 0 10px;
        font-size: 15px;
    }

    .card-number {
        font-size: 32px;
        font-weight: bold;
    }

    .total {
        background: #286b54;
    }

    .pending-card {
        background: #d97706;
    }

    .completed-card {
        background: #3f7d55;
    }

    .overdue-card {
        background: #b91c1c;
    }

    /* ADD BUTTON */

    .add-button {
        display: inline-block;
        background: #e8892d;
        color: white;
        padding: 13px 20px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .add-button:hover {
        background: #cf711b;
    }

    /* TASK TABLE */

    .task-box {
        background: #fffaf0;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 5px 20px rgba(40, 30, 20, 0.12);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #286b54;
        color: white;
        padding: 14px;
        text-align: left;
    }

    th:first-child {
        border-radius: 8px 0 0 8px;
    }

    th:last-child {
        border-radius: 0 8px 8px 0;
    }

    td {
        padding: 15px 14px;
        border-bottom: 1px solid #e7dccb;
        color: #3f3327;
    }

    tr:hover {
        background: #f9f1e3;
    }

    /* STATUS */

    .pending {
        display: inline-block;
        background: #fff0d5;
        color: #a85d00;
        padding: 6px 10px;
        border-radius: 20px;
        font-weight: bold;
    }

    .completed {
        display: inline-block;
        background: #dcefe5;
        color: #17633f;
        padding: 6px 10px;
        border-radius: 20px;
        font-weight: bold;
    }

    .overdue {
        display: inline-block;
        background: #fee2e2;
        color: #991b1b;
        padding: 6px 10px;
        border-radius: 20px;
        font-weight: bold;
    }

    /* ACTION BUTTONS */

    .buttons {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .status-button {
        background: #286b54;
        color: white;
        border: none;
        padding: 8px 11px;
        border-radius: 7px;
        cursor: pointer;
        font-weight: bold;
    }

    .status-button:hover {
        background: #174c3c;
    }

    .edit-button {
        background: #d97706;
        color: white;
        padding: 8px 11px;
        border-radius: 7px;
        text-decoration: none;
        font-weight: bold;
    }

    .edit-button:hover {
        background: #b45309;
    }

    .delete-button {
        background: #b91c1c;
        color: white;
        border: none;
        padding: 8px 11px;
        border-radius: 7px;
        cursor: pointer;
        font-weight: bold;
    }

    .delete-button:hover {
        background: #991b1b;
    }

    /* EMPTY */

    .empty {
        text-align: center;
        padding: 40px;
        color: #6b5a47;
    }

    .empty h2 {
        color: #286b54;
    }

    /* MOBILE */

    @media (max-width: 800px) {

        .dashboard {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media (max-width: 500px) {

        body {
            padding: 20px;
        }

        .dashboard {
            grid-template-columns: 1fr;
        }

    }
</style>
```

</head>

<body>

<div class="container">

```
<!-- HEADER -->

<div class="header">

    <h1>Personal Task Manager</h1>

    <p>
        Keep your tasks organized and stay productive.
    </p>

</div>


<!-- DASHBOARD CARDS -->

<div class="dashboard">

    <div class="card total">

        <h3>Total Tasks</h3>

        <div class="card-number">
            {{ $totalTasks }}
        </div>

    </div>


    <div class="card pending-card">

        <h3>Pending</h3>

        <div class="card-number">
            {{ $pendingTasks }}
        </div>

    </div>


    <div class="card completed-card">

        <h3>Completed</h3>

        <div class="card-number">
            {{ $completedTasks }}
        </div>

    </div>


    <div class="card overdue-card">

        <h3>Overdue</h3>

        <div class="card-number">
            {{ $overdueTasks }}
        </div>

    </div>

</div>


<!-- ADD TASK BUTTON -->

<a
    href="{{ route('tasks.create') }}"
    class="add-button"
>
    + Add New Task
</a>


<!-- TASK LIST -->

@if($tasks->count() > 0)

    <div class="task-box">

        <table>

            <thead>

                <tr>

                    <th>Task Name</th>

                    <th>Description</th>

                    <th>Status</th>

                    <th>Due Date</th>

                    <th>Actions</th>

                </tr>

            </thead>


            <tbody>

                @foreach($tasks as $task)

                    <tr>

                        <!-- TASK NAME -->

                        <td>

                            <strong>
                                {{ $task->task_name }}
                            </strong>

                        </td>


                        <!-- DESCRIPTION -->

                        <td>

                            {{ $task->description ?? 'No description' }}

                        </td>


                        <!-- STATUS -->

                        <td>

                            @if($task->status === 'Completed')

                                <span class="completed">
                                    ✓ Completed
                                </span>

                            @elseif(
                                $task->due_date &&
                                $task->due_date < now()->toDateString()
                            )

                                <span class="overdue">
                                    ⚠ Overdue
                                </span>

                            @else

                                <span class="pending">
                                    Pending
                                </span>

                            @endif

                        </td>


                        <!-- DUE DATE -->

                        <td>

                            {{ $task->due_date ?? 'No due date' }}

                        </td>


                        <!-- ACTIONS -->

                        <td>

                            <div class="buttons">


                                <!-- EDIT -->

                                <a
                                    href="{{ route('tasks.edit', $task) }}"
                                    class="edit-button"
                                >
                                    Edit
                                </a>


                                <!-- CHANGE STATUS -->

                                <form
                                    action="{{ route('tasks.status', $task) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="status-button"
                                    >
                                        Change Status
                                    </button>

                                </form>


                                <!-- DELETE -->

                                <form
                                    action="{{ route('tasks.destroy', $task) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this task?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-button"
                                    >
                                        Delete
                                    </button>

                                </form>


                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>


@else

    <!-- NO TASKS -->

    <div class="task-box">

        <div class="empty">

            <h2>No Tasks Yet</h2>

            <p>
                Add your first task to get started!
            </p>

        </div>

    </div>

@endif
```

</div>

</body>

</html><!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Personal Task Manager</title>

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
        max-width: 1100px;
        margin: auto;
    }

    /* HEADER */

    .header {
        background: #174c3c;
        color: white;
        padding: 30px;
        border-radius: 16px;
        margin-bottom: 25px;
    }

    .header h1 {
        margin: 0 0 8px;
        font-size: 34px;
    }

    .header p {
        margin: 0;
        color: #d8eee5;
    }

    /* DASHBOARD */

    .dashboard {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .card {
        padding: 22px;
        border-radius: 12px;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .card h3 {
        margin: 0 0 10px;
        font-size: 15px;
    }

    .card-number {
        font-size: 32px;
        font-weight: bold;
    }

    .total {
        background: #286b54;
    }

    .pending-card {
        background: #d97706;
    }

    .completed-card {
        background: #3f7d55;
    }

    .overdue-card {
        background: #b91c1c;
    }

    /* ADD BUTTON */

    .add-button {
        display: inline-block;
        background: #e8892d;
        color: white;
        padding: 13px 20px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .add-button:hover {
        background: #cf711b;
    }

    /* FILTERS */

    .filters {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .filter-button {
        display: inline-block;
        background: #e7dccb;
        color: #174c3c;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
    }

    .filter-button:hover {
        background: #d8cbb8;
    }

    .filter-button.active {
        background: #286b54;
        color: white;
    }

    /* TASK TABLE */

    .task-box {
        background: #fffaf0;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 5px 20px rgba(40, 30, 20, 0.12);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #286b54;
        color: white;
        padding: 14px;
        text-align: left;
    }

    th:first-child {
        border-radius: 8px 0 0 8px;
    }

    th:last-child {
        border-radius: 0 8px 8px 0;
    }

    td {
        padding: 15px 14px;
        border-bottom: 1px solid #e7dccb;
        color: #3f3327;
    }

    tr:hover {
        background: #f9f1e3;
    }

    /* STATUS */

    .pending {
        display: inline-block;
        background: #fff0d5;
        color: #a85d00;
        padding: 6px 10px;
        border-radius: 20px;
        font-weight: bold;
    }

    .completed {
        display: inline-block;
        background: #dcefe5;
        color: #17633f;
        padding: 6px 10px;
        border-radius: 20px;
        font-weight: bold;
    }

    .overdue {
        display: inline-block;
        background: #fee2e2;
        color: #991b1b;
        padding: 6px 10px;
        border-radius: 20px;
        font-weight: bold;
    }

    /* ACTION BUTTONS */

    .buttons {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .status-button {
        background: #286b54;
        color: white;
        border: none;
        padding: 8px 11px;
        border-radius: 7px;
        cursor: pointer;
        font-weight: bold;
    }

    .status-button:hover {
        background: #174c3c;
    }

    .edit-button {
        background: #d97706;
        color: white;
        padding: 8px 11px;
        border-radius: 7px;
        text-decoration: none;
        font-weight: bold;
    }

    .edit-button:hover {
        background: #b45309;
    }

    .delete-button {
        background: #b91c1c;
        color: white;
        border: none;
        padding: 8px 11px;
        border-radius: 7px;
        cursor: pointer;
        font-weight: bold;
    }

    .delete-button:hover {
        background: #991b1b;
    }

    /* EMPTY */

    .empty {
        text-align: center;
        padding: 40px;
        color: #6b5a47;
    }

    .empty h2 {
        color: #286b54;
    }

    /* MOBILE */

    @media (max-width: 800px) {

        .dashboard {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media (max-width: 500px) {

        body {
            padding: 20px;
        }

        .dashboard {
            grid-template-columns: 1fr;
        }

    }
</style>
```

</head>

<body>

<div class="container">

```
<!-- HEADER -->

<div class="header">

    <h1>Personal Task Manager</h1>

    <p>
        Keep your tasks organized and stay productive.
    </p>

</div>


<!-- DASHBOARD -->

<div class="dashboard">

    <div class="card total">

        <h3>Total Tasks</h3>

        <div class="card-number">
            {{ $totalTasks }}
        </div>

    </div>


    <div class="card pending-card">

        <h3>Pending</h3>

        <div class="card-number">
            {{ $pendingTasks }}
        </div>

    </div>


    <div class="card completed-card">

        <h3>Completed</h3>

        <div class="card-number">
            {{ $completedTasks }}
        </div>

    </div>


    <div class="card overdue-card">

        <h3>Overdue</h3>

        <div class="card-number">
            {{ $overdueTasks }}
        </div>

    </div>

</div>


<!-- ADD TASK -->

<a
    href="{{ route('tasks.create') }}"
    class="add-button"
>
    + Add New Task
</a>


<!-- FILTERS -->

<div class="filters">

    <a
        href="{{ route('tasks.index', ['filter' => 'all']) }}"
        class="filter-button {{ $filter === 'all' ? 'active' : '' }}"
    >
        All Tasks
    </a>


    <a
        href="{{ route('tasks.index', ['filter' => 'pending']) }}"
        class="filter-button {{ $filter === 'pending' ? 'active' : '' }}"
    >
        Pending
    </a>


    <a
        href="{{ route('tasks.index', ['filter' => 'completed']) }}"
        class="filter-button {{ $filter === 'completed' ? 'active' : '' }}"
    >
        Completed
    </a>

</div>


<!-- TASK LIST -->

@if($tasks->count() > 0)

    <div class="task-box">

        <table>

            <thead>

                <tr>

                    <th>Task Name</th>

                    <th>Description</th>

                    <th>Status</th>

                    <th>Due Date</th>

                    <th>Actions</th>

                </tr>

            </thead>


            <tbody>

                @foreach($tasks as $task)

                    <tr>

                        <!-- TASK NAME -->

                        <td>

                            <strong>
                                {{ $task->task_name }}
                            </strong>

                        </td>


                        <!-- DESCRIPTION -->

                        <td>

                            {{ $task->description ?? 'No description' }}

                        </td>


                        <!-- STATUS -->

                        <td>

                            @if($task->status === 'Completed')

                                <span class="completed">
                                    ✓ Completed
                                </span>

                            @elseif(
                                $task->due_date &&
                                $task->due_date < now()->toDateString()
                            )

                                <span class="overdue">
                                    ⚠ Overdue
                                </span>

                            @else

                                <span class="pending">
                                    Pending
                                </span>

                            @endif

                        </td>


                        <!-- DUE DATE -->

                        <td>

                            {{ $task->due_date ?? 'No due date' }}

                        </td>


                        <!-- ACTIONS -->

                        <td>

                            <div class="buttons">

                                <!-- EDIT -->

                                <a
                                    href="{{ route('tasks.edit', $task) }}"
                                    class="edit-button"
                                >
                                    Edit
                                </a>


                                <!-- CHANGE STATUS -->

                                <form
                                    action="{{ route('tasks.status', $task) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="status-button"
                                    >
                                        Change Status
                                    </button>

                                </form>


                                <!-- DELETE -->

                                <form
                                    action="{{ route('tasks.destroy', $task) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this task?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-button"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>


@else

    <div class="task-box">

        <div class="empty">

            <h2>No Tasks Found</h2>

            @if($filter === 'pending')

                <p>
                    You don't have any pending tasks.
                </p>

            @elseif($filter === 'completed')

                <p>
                    You don't have any completed tasks.
                </p>

            @else

                <p>
                    Add your first task to get started!
                </p>

            @endif

        </div>

    </div>

@endif
```

</div>

</body>

</html>
