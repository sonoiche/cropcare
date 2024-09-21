@if (isset($gis->farmer_id))
<div class="mb-3">
    <label class="form-label">Farmer's Name</label>
    <input type="text" name="fullname" class="form-control" placeholder="Farmer's Name" value="{{ $gis->farmer->fullname ?? '' }}" />
</div>
@else
<div class="mb-3">
    <label class="form-label">Farmer's Name</label>
    <input type="text" name="fullname" class="form-control" placeholder="Farmer's Name" value="{{ $consultation->farmer_fullname ?? '' }}" />
</div>
@endif
<div class="mb-3">
    <label class="form-label">Geographic Name</label>
    <input type="text" name="name" class="form-control" placeholder="Name of Geographic Feature" value="{{ $gis->name ?? '' }}" />
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" id="description" style="resize: none" rows="5" class="form-control w-100">{{ $gis->description ?? '' }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Location</label>
    <input type="text" name="location" class="form-control" placeholder="Location" value="{{ $gis->location ?? '' }}" />
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Latitude</label>
        <input type="text" name="latitude" class="form-control" placeholder="Latitude" value="{{ $gis->latitude ?? '' }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label">Longitude</label>
        <input type="text" name="longitude" class="form-control" placeholder="Longitude" value="{{ $gis->longitude ?? '' }}" />
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Crop Name</label>
        <input type="text" name="crop_name" class="form-control" placeholder="Crop Name" value="{{ $gis->crop_name ?? '' }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label">Crop Count</label>
        <input type="text" name="crop_count" class="form-control" placeholder="Crop Count" value="{{ $gis->crop_count ?? '' }}" />
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Crop Yield</label>
        <input type="number" name="crop_yield" class="form-control" placeholder="Crop Yield" value="{{ $gis->crop_yield ?? '' }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" id="status" class="form-select">
            <option value="">Select Status</option>
            <option value="Available" {{ (isset($gis->status) && $gis->status == 'Available') ? 'selected' : '' }}>Available</option>
            <option value="Owned" {{ (isset($gis->status) && $gis->status == 'Owned') ? 'selected' : '' }}>Owned</option>
        </select>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Photo</label>
    @if (isset($gis->photo))
    <div>
        
    </div>
    @else
    <input type="file" name="photo" id="photo" class="form-control" />
    @endif
</div>
<div class="mb-3">
    <label class="form-label">Remarks</label>
    <textarea name="remarks" id="remarks" style="resize: none" rows="5" class="form-control w-100">{{ $gis->remarks ?? '' }}</textarea>
</div>