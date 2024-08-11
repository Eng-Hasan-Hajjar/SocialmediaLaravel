@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('content')
    <div class="container">
        <h1>Create Recommendation</h1>

        <form action="{{ route('recommendations.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select class="form-select" id="user_id" name="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="product_id" class="form-label">Product</label>
                <select class="form-select" id="product_id" name="product_id" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="recommendable_type" class="form-label">Recommendable Type</label>
                <select class="form-select" id="recommendable_type" name="recommendable_type" required>
                    <option value="App\Models\FacebookPage">Facebook Page</option>
                    <option value="App\Models\InstagramAccount">Instagram Account</option>
                    <option value="App\Models\YouTubeChannel">YouTube Channel</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="recommendable_id" class="form-label">Recommendable</label>
                <select class="form-select" id="recommendable_id" name="recommendable_id" required>
                    @foreach($facebookPages as $page)
                        <option value="{{ $page->id }}" data-type="App\Models\FacebookPage">{{ $page->name }}</option>
                    @endforeach
                    @foreach($instagramAccounts as $account)
                        <option value="{{ $account->id }}" data-type="App\Models\InstagramAccount">{{ $account->name }}</option>
                    @endforeach
                    @foreach($youtubeChannels as $channel)
                        <option value="{{ $channel->id }}" data-type="App\Models\YouTubeChannel">{{ $channel->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Recommendation</button>
        </form>
    </div>
@endsection
