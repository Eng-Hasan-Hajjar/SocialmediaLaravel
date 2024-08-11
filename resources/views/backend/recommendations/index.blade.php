@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('content')
    <div class="container">
        <h1>Recommendations</h1>
        <a href="{{ route('recommendations.create') }}" class="btn btn-primary mb-3">Add New Recommendation</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Product</th>
                    <th>Recommended Platform</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recommendations as $recommendation)
                    <tr>
                        <td>{{ $recommendation->user->name }}</td>
                        <td>{{ $recommendation->product->name }}</td>
                        <td>
                            @if ($recommendation->recommendable_type === 'App\\Models\\FacebookPage')
                                Facebook Page: {{ $recommendation->recommendable->name }}
                            @elseif ($recommendation->recommendable_type === 'App\\Models\\InstagramAccount')
                                Instagram Account: {{ $recommendation->recommendable->name }}
                            @elseif ($recommendation->recommendable_type === 'App\\Models\\YouTubeChannel')
                                YouTube Channel: {{ $recommendation->recommendable->name }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('recommendations.edit', $recommendation->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('recommendations.destroy', $recommendation->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
