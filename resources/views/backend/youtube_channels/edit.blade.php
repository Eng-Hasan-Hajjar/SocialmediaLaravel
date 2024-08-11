@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('content')
    <div class="container">
        <h1>Edit YouTube Channel</h1>

        <form action="{{ route('youtube_channels.update', $youtubeChannel->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $youtubeChannel->name }}" required>
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="url" class="form-control" id="url" name="url" value="{{ $youtubeChannel->url }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $youtubeChannel->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="subscribers_count" class="form-label">Subscribers Count</label>
                <input type="number" class="form-control" id="subscribers_count" name="subscribers_count" value="{{ $youtubeChannel->subscribers_count }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"{{ $youtubeChannel->category_id == $category->id ? ' selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Channel</button>
        </form>
    </div>
@endsection
