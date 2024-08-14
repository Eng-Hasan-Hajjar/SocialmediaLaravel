@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('content')
    <div class="container">
        <h1>Instagram Account Details</h1>
        <a href="{{ route('instagram_accounts.index') }}" class="btn btn-primary mb-3">Back to List</a>

        <div class="card">
            <div class="card-header">
                {{ $instagramAccount->name }}
            </div>
            <div class="card-body">
                <p><strong>URL:</strong> <a href="{{ $instagramAccount->url }}" target="_blank">{{ $instagramAccount->url }}</a></p>
                <p><strong>Description:</strong> {{ $instagramAccount->description }}</p>
                <p><strong>Followers Count:</strong> {{ $instagramAccount->followers_count }}</p>
                <p><strong>Category:</strong> {{ $instagramAccount->category->name }}</p>
                <p><strong>Location (Country):</strong> {{ $instagramAccount->location }}</p>

            </div>
        </div>
    </div>
@endsection
