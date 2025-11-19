<div class="card-body row">

    <div class="form-group col-6">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name"
            value="{{ old('name', $category->name ?? '') }}" required>
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @if ($errors->has('image'))
            <span class="text-danger">{{ $errors->first('image') }}</span>
        @endif

        @if (isset($category->image))
            <div class="mt-3">
                <img src="{{ asset('storage/app/public/' . $category->image) }}" alt="{{ $category->name }}"
                    width="100">
            </div>
        @endif
    </div>


    <div class="form-group col-12">
        <label for="subscription_id">Subscription</label>
        <select class="form-control" id="subscription_id" name="subscription_id[]" multiple="multiple" required>
            @foreach ($subscriptions as $item)
                <option value="{{ $item->id }}"
                    {{ in_array($item->id, old('subscription_id', isset($category) ? $category->subscriptions->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
        @error('subscription_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
