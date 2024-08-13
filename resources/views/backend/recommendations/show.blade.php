@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('content')
    <div class="container">
        <h1>Recommendation Details</h1>
        <a href="{{ route('recommendations.index') }}" class="btn btn-primary mb-3">Back to List</a>

        <div class="card">
            <div class="card-header">
                Recommendation for {{ $recommendation->product->name }}
            </div>
            <div class="card-body">
                <p><strong>User:</strong> {{ $recommendation->user->name }}</p>
                <p><strong>Product:</strong> {{ $recommendation->product->name }}</p>
                <p><strong>Recommendable Type:</strong> {{ class_basename($recommendation->recommendable_type) }}</p>
                <p><strong>Recommendable:</strong>
                    @if($recommendation->recommendable_type === 'App\Models\FacebookPage')
                        {{ $recommendation->recommendable->name }}
                    @elseif($recommendation->recommendable_type === 'App\Models\InstagramAccount')
                        {{ $recommendation->recommendable->name }}
                    @elseif($recommendation->recommendable_type === 'App\Models\YouTubeChannel')
                        {{ $recommendation->recommendable->name }}
                    @else
                        Unknown
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection
