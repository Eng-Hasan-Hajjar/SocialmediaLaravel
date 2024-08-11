@extends('layouts.backend')

@section('content')
    <h2>Create Category</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
