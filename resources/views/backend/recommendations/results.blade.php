





    <div class="container">
        <h1>Recommendations</h1>
        <a href="{{ route('recommendations.index') }}" class="btn btn-primary mb-3">Back to List</a>

        <div class="card">
            <div class="card-header">
                Recommendations for {{ $platform }}
            </div>
            <div class="card-body">
                @if($recommendations->isEmpty())
                    <p>No recommendations found.</p>
                @else
                    <ul>
                        @foreach($recommendations as $recommendation)
                            <li>{{ $recommendation->name }} - {{ $recommendation->location }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
