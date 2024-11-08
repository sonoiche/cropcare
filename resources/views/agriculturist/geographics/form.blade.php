<div class="mb-3">
    <label class="form-label">Farmer's Name</label>
    <div class="input-group">
        <select name="farmer_id" id="farmer_id" class="form-select">
            <option value="">Select Farmer</option>
            @foreach ($farmers as $farmer)
            <option value="{{ $farmer->id }}" {{ (isset($gis->farmer_id) && $gis->farmer_id == $farmer->id) ? 'selected' : '' }}>{{ $farmer->fullname }}</option>
            @endforeach
        </select>
        <a href="{{ url('president/farmers/create') }}" class="btn btn-primary">Add Farmer</a>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">Geographic Name</label>
            <select name="name" id="geo_name" class="form-select">
                <option value="">Select Name</option>
                <option value="Plains" {{ (isset($gis->name) && $gis->name == 'Plains') ? 'selected' : '' }}>Plains</option>
                <option value="Mountains" {{ (isset($gis->name) && $gis->name == 'Mountains') ? 'selected' : '' }}>Mountains</option>
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">Farm Area</label>
            <select name="farm_area" id="farm_area" class="form-select">
                <option value="">Select Farm Area</option>
                <option value="Square Meter" {{ (isset($gis->farm_area) && $gis->farm_area == 'Square Meter') ? 'selected' : '' }}>Square Meter (SQM)</option>
                <option value="Hectares" {{ (isset($gis->farm_area) && $gis->farm_area == 'Hectares') ? 'selected' : '' }}>Hectares</option>
            </select>
        </div>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Farm Location</label>
    <input type="text" name="location" class="form-control" placeholder="Location" value="{{ $gis->location ?? '' }}" />
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Crop Name</label>
        <select name="crop_name" id="crop_name" class="form-select">
            <option value="">Select Crop Name</option>
            <option value="Rice" {{ (isset($gis->crop_name) && $gis->crop_name == 'Rice') ? 'selected' : '' }}>Rice</option>
            <option value="Corn" {{ (isset($gis->crop_name) && $gis->crop_name == 'Corn') ? 'selected' : '' }}>Corn</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Crop Count (KG)</label>
        <input type="text" name="crop_count" class="form-control" placeholder="Crop Count per KG" value="{{ $gis->crop_count ?? '' }}" />
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Crop Yield (KG) <i>Inani</i></label>
        <input type="number" name="crop_yield" class="form-control" placeholder="Crop Yield per KG" value="{{ $gis->crop_yield ?? '' }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" id="status" class="form-select">
            <option value="">Select Status</option>
            <option value="Tenant" {{ (isset($gis->status) && $gis->status == 'Tenant') ? 'selected' : '' }}>Tenant</option>
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