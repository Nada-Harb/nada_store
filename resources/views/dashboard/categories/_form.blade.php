    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>

    </div>
    @endif

    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $category->name) }}">
        @error('name')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">URL slug</label>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug', $category->slug) }}">
        @error('slug')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="parent_id" class="form-label"> Category Parent </label>
        <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
            <option value="">No Parent</option>
            @foreach($parents as $parent)
            <option value="{{ $parent->id }}" @selected( $parent->id == old('parent_id', $category->parent_id))>{{ $parent->name }}</option>
            @endforeach
        </select>
        @error('parent_id')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
        @error('image')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>