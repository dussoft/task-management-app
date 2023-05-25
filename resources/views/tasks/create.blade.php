@extends('layouts.app')

@section('content')
    <h1>Create Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Task Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <button type="submit">Save</button>
    </form>
@endsection
