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
    <label class="form-label">Concern / Letter</label>
    <textarea name="concern" id="concern" class="w-100 form-control" rows="8" style="resize: none">{{ $consultation->concern ?? '' }}</textarea>
</div>