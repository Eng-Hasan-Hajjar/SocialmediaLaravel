@extends('layouts.backend')

@section('content')
    <h2>Edit Category</h2>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
