@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Task Name:</label>
            <input type="text" id="name" name="name" value="{{ $task->name }}" required>
        </div>

        <button type="submit">Save</button>
    </form>
@endsection
