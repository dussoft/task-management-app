@extends('layouts.app')

@section('content')
    <h1>Task Management</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <ul id="tasks">
        @foreach ($tasks as $task)
            <li class="task" data-task-id="{{ $task->id }}">
                <input type="text" value="{{ $task->name }}">
                <button class="btn btn-edit">Edit</button>
                <button class="btn btn-delete">Delete</button>
            </li>
        @endforeach
    </ul>
@endsection
