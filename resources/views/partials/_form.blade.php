@csrf
<div class="form-group">
    {{-- <label for="file" class="form-label">Default file input example</label> --}}
    @if ($project->image)
        <img src="/storage/{{ $project->image }}" class="w-100 object-fit-cover" style="height: 250px" alt="">
    @endif
    <input class="form-control" type="file" id="file" name="image" value="">
  </div>
<div class="form-group">
    <label for="category_id">Project's Category</label>
    <select
        name="category_id"
        id="category_id"
        class="form-control border-0 bg-light shadow-sm"
    >
        <option value="">Select</option>
        @foreach ($categories as $id => $name)
            <option
                value="{{ $id }}"
                @if ( $id === +old("category_id", $project->category_id) ) selected @endif
            >{{ $name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="title">Project's Title</label>
    <input class="form-control bg-light border-0 shadow-sm" type="text" name="title" id="title" value="{{ old("title", $project->title) }}">
</div>
<br>
<div class="form-group">
    <label for="slug">Project's Slug</label>
        <input class="form-control bg-light border-0 shadow-sm" type="text" name="slug" id="slug" value="{{ old("slug", $project->slug) }}">
</div>
<br>
<div class="form-group">
    <label for="description">Project's Description</label>
        <textarea class="form-control bg-light border-0 shadow-sm" type="text" name="description" id="description">{{ old("description", $project->description) }}</textarea>
</div>
<br>
<button class="btn btn-primary btn-lg w-100" type="submit">
    Save
</button>