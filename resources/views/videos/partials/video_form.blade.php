<div class="card-body">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $video->title ?? '') }}" required>
        @error('title')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <select class="form-control" id="category_id" name="category_id" required>
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $video->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-6">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @if ($errors->has('image'))
            <span class="text-danger">{{ $errors->first('image') }}</span>
        @endif

        @if (isset($video->image))
            <div class="mt-3">
                <img src="{{ asset('storage/app/public/'.$video->image) }}" alt="{{ $video->title }}" width="100">
            </div>
        @endif
    </div>


    <div class="form-group">
        <label for="video">Video File</label>
        <input type="file" class="form-control-file" id="video" name="video">
        @error('video')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <select class="form-control" id="type" name="type" required>
            <option value="">Select Type</option>
            <option value="VR" {{ old('type', $video->type ?? '') == 'VR' ? 'selected' : '' }}>VR</option>
            <option value="Mobile" {{ old('type', $video->type ?? '') == 'Mobile' ? 'selected' : '' }}>Mobile</option>
        </select>
        @error('type')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

