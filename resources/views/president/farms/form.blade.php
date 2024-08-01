<div class="mb-3">
    <label class="form-label">Farmer Name</label>
    <select name="farmer_id" id="farmer_id" class="form-select">
        <option value="">--</option>
        @foreach ($farmers as $farmer)
        <option value="{{ $farmer->id }}" {{ (isset($farm->farmer_id) && $farm->farmer_id == $farmer->id) ? 'selected' : '' }}>{{ $farmer->fullname }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Crop Name</label>
    <input type="text" name="crop_name" class="form-control" placeholder="Crop Name" value="{{ $farm->crop_name ?? '' }}" />
</div>
<div class="mb-3">
    <label class="form-label">Location</label>
    <input type="text" name="location" class="form-control" placeholder="Location" value="{{ $farm->location ?? '' }}" />
</div>
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">Latitide</label>
            <input type="text" name="lat" class="form-control" placeholder="Latitude" value="{{ $farm->lat ?? '' }}" />
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">Longitude</label>
            <input type="text" name="lng" class="form-control" placeholder="Longitude" value="{{ $farm->lng ?? '' }}" />
        </div>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Acres</label>
    <input type="number" name="acres" class="form-control" placeholder="Acres" value="{{ $farm->acres ?? '' }}" />
</div>
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">Crop Count</label>
            <input type="number" name="crop_count" class="form-control" placeholder="Crop Count" value="{{ $farm->crop_count ?? '' }}" />
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">Crop Yield</label>
            <input type="text" name="crop_yield" class="form-control" placeholder="Crop Yield" value="{{ $farm->crop_yield ?? '' }}" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">Bill Type</label>
            <select name="bill_type" id="bill_type" class="form-select">
                <option value="">--</option>
                <option value="For Lease" {{ (isset($farm->bill_type) && $farm->bill_type == 'For Lease') ? 'selected' : '' }}>For Lease</option>
                <option value="For Sale" {{ (isset($farm->bill_type) && $farm->bill_type == 'For Sale') ? 'selected' : '' }}>For Sale</option>
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">Acre Price</label>
            <input type="text" name="acre_value" class="form-control" placeholder="Acre Price" value="{{ $farm->acre_value ?? '' }}" />
        </div>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" id="status" class="form-select">
        <option value="">--</option>
        <option value="Owned" {{ (isset($farm->status) && $farm->status == 'Owned') ? 'selected' : '' }}>Owned</option>
        <option value="Available" {{ (isset($farm->status) && $farm->status == 'Available') ? 'selected' : '' }}>Available</option>
    </select>
</div>
