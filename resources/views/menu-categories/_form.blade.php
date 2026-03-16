<div class="row g-3">
    <div class="col-md-8">
        <div class="form-floating">
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', isset($category) ? $category->name : '') }}"
                   placeholder="Category Name" required>
            <label for="name"><i class="fas fa-folder-open me-1"></i> Category Name</label>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating">
            <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror" required>
                <option value="1" {{ old('is_active', (string) (isset($category) ? $category->is_active : '1')) === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', (string) (isset($category) ? $category->is_active : '1')) === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            <label for="is_active"><i class="fas fa-toggle-on me-1"></i> Status</label>
            @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <div class="form-floating">
            <textarea name="description" id="description"
                      class="form-control @error('description') is-invalid @enderror"
                      placeholder="Category Description"
                      style="height: 110px">{{ old('description', isset($category) ? $category->description : '') }}</textarea>
            <label for="description"><i class="fas fa-align-left me-1"></i> Description</label>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="d-flex justify-content-between border-top pt-3 mt-4">
    <a href="{{ route('menu-categories.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to Categories
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> {{ $submitLabel }}
    </button>
</div>
