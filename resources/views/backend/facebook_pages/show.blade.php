@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('content')
    <div class="container">
        <h1>Facebook Page Details</h1>
        <a href="{{ route('facebook_pages.index') }}" class="btn btn-primary mb-3">Back to List</a>

        <div class="card">
            <div class="card-header">
                {{ $facebookPage->name }}
            </div>
            <div class="card-body">
                <p><strong>URL:</strong> <a href="{{ $facebookPage->url }}" target="_blank">{{ $facebookPage->url }}</a></p>
                <p><strong>Description:</strong> {{ $facebookPage->description }}</p>
                <p><strong>Followers Count:</strong> {{ $facebookPage->followers_count }}</p>
                <p><strong>Category:</strong> {{ $facebookPage->category->name }}</p>
            </div>
        </div>
    </div>
@endsection
