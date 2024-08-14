<!-- recommendation_form.blade.php -->
<form action="{{ route('recommendations.recommend') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="platform">Select Platform</label>
        <select name="platform" id="platform" class="form-control" required>
            <option value="facebook">Facebook</option>
            <option value="instagram">Instagram</option>
            <option value="youtube">YouTube</option>
        </select>
    </div>
  
    <div class="form-group">
        <select name="category_id" class="form-select">
            <option value="">Select Product Type</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Get Recommendations</button>
</form>
