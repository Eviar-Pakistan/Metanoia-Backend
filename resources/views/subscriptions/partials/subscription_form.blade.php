<div class="card-body">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $subscription->name ?? '') }}" required>
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $subscription->price ?? '') }}" required>
        @error('price')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="duration">Duration ( IN Days )</label>
        <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration', $subscription->duration ?? '') }}" required>
        @error('duration')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div id="details-container">
        @if (isset($subscription) && $subscription->details)
            @foreach (json_decode($subscription->details, true) as $detail)
                <div class="form-group detail-item" style="display: flex;">
                    <input type="text" class="form-control" name="details[]" value="{{ $detail }}" required>
                    <button type="button" class="btn btn-sm btn-danger remove-detail">-</button>
                </div>
            @endforeach
        @else
            <div class="form-group detail-item" style="display: flex;">
                <input type="text" class="form-control" name="details[]" required>
                <button type="button" class="btn btn-sm btn-danger remove-detail mx-2">-</button>
            </div>
        @endif
    </div>
    <button type="button" class="btn btn-sm btn-success add-detail">+</button>
</div>
@section('script')
<script>
    // Add detail dynamically
    $(document).ready(function() {
        $('.add-detail').click(function() {
            var html = '<div class="form-group detail-item" style="display: flex;">' +
                            '<input type="text" class="form-control" name="details[]" required>' +
                            '<button type="button" class="btn btn-sm btn-danger remove-detail mx-2">-</button>' +
                        '</div>';
            $('#details-container').append(html);
        });

        // Remove detail dynamically
        $(document).on('click', '.remove-detail', function() {
            $(this).closest('.detail-item').remove();
        });
    });
</script>
@endsection
