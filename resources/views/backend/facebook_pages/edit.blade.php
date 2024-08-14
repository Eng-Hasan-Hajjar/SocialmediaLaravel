@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('content')
    <div class="container">
        <h1>Edit Facebook Page</h1>

        <form action="{{ route('facebook_pages.update', $facebookPage->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $facebookPage->name }}" required>
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="url" class="form-control" id="url" name="url" value="{{ $facebookPage->url }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $facebookPage->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="followers_count" class="form-label">Followers Count</label>
                <input type="number" class="form-control" id="followers_count" name="followers_count" value="{{ $facebookPage->followers_count }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"{{ $facebookPage->category_id == $category->id ? ' selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location (Country)</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $facebookPage->location ?? '') }}" placeholder="Enter location">
            </div>
            <button type="submit" class="btn btn-primary">Update Page</button>
        </form>
    </div>
@endsection
