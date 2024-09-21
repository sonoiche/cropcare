<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" placeholder="Consultaion Title" value="{{ $consultation->title ?? '' }}" />
</div>
<div class="mb-3">
    <label class="form-label">Farmer</label>
    <select name="farmer_id" id="farmer_id" class="form-select">
        <option value="">Select Farmer</option>
        @foreach ($farmers as $farmer)
        <option value="{{ $farmer->id }}" {{ (isset($consultation->farmer_id) && $consultation->farmer_id == $farmer->id) ? 'selected' : '' }}>{{ $farmer->fullname }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Location</label>
    <select name="location_id" id="location_id" class="form-select">
        <option value="">Select Location</option>
        @foreach ($lands as $land)
        <option value="{{ $land->id }}" {{ (isset($consultation->location_id) && $consultation->location_id == $land->id) ? 'selected' : '' }}>{{ $land->location }}</option>
        @endforeach
    </select>
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
        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
        @endforeach
    </select>
</div> --}}