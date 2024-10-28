<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" placeholder="Consultaion Title" value="{{ $consultation->title ?? '' }}" />
</div>
<div class="mb-3">
    <label class="form-label">Farmer's Fullname</label>
    <input type="text" name="farmer_fullname" class="form-control" placeholder="Farmer's Fullname" value="{{ $consultation->farmer_fullname ?? '' }}" />
</div>
<div class="mb-3">
    <label class="form-label">Location</label>
    <input type="text" name="location" class="form-control" placeholder="Location" value="{{ $consultation->location ?? '' }}" />
</div>
<div class="mb-3">
    <label class="form-label">Photo</label>
    <input type="file" name="photo" class="form-control" />
</div>
<div class="mb-3">
    <label class="form-label">Concern / Letter</label>
    <textarea name="concern" id="concern" class="w-100 form-control" rows="8" style="resize: none">{{ $consultation->concern ?? '' }}</textarea>
</div>
{{-- <div class="mb-3">
    <label class="form-label">Send To</label>
    <select name="agriculture_id" id="agriculture_id" class="form-select">
        <option value="">Select Agriculturist</option>
        @foreach ($agriculturists as $user)
        <option value="{{ $user->id }}" {{ (isset($consultation->agriculture_id) && $consultation->agriculture_id == $user->id) ? 'selected' : '' }}>{{ $user->fullname }}</option>
        @endforeach
    </select>
</div> --}}