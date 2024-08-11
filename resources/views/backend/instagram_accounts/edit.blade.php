@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>Edit Instagram Account</h1>

        <form action="{{ route('instagram_accounts.update', $instagramAccount->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $instagramAccount->name }}" required>
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="url" class="form-control" id="url" name="url" value="{{ $instagramAccount->url }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $instagramAccount->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="followers_count" class="form-label">Followers Count</label>
                <input type="number" class="form-control" id="followers_count" name="followers_count" value="{{ $instagramAccount->followers_count }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"{{ $instagramAccount->category_id == $category->id ? ' selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Account</button>
        </form>
    </div>
@endsection
