@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('content')
    <div class="container">
        <h1>YouTube Channel Details</h1>
        <a href="{{ route('youtube_channels.index') }}" class="btn btn-primary mb-3">Back to List</a>

        <div class="card">
            <div class="card-header">
                {{ $youTubeChannel->name }}
            </div>
            <div class="card-body">
                <p><strong>URL:</strong> <a href="{{ $youTubeChannel->url }}" target="_blank">{{ $youTubeChannel->url }}</a></p>
                <p><strong>Description:</strong> {{ $youTubeChannel->description }}</p>
                <p><strong>Subscribers Count:</strong> {{ $youTubeChannel->subscribers_count }}</p>
                <p><strong>Category:</strong> {{ $youTubeChannel->category->name }}</p>
                <p><strong>Location (Country):</strong> {{ $youtubeChannel->location }}</p>
                    @if ($youTubeChannel->image)
                        <div class="row mb-3">
                            <div class="col">
                                <strong>Image:</strong>
                                <img src="{{ URL::to('/') }}/images/{{ $youTubeChannel->image }}" class="img-thumbnail" style="width: 300px; height: auto;" />

                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
@endsection
