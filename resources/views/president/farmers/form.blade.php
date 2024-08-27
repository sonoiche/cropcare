<div class="mb-3">
    <label class="form-label">Fullname</label>
    <input type="text" name="fullname" class="form-control" placeholder="Fullname" value="{{ $farmer->fullname ?? '' }}" />
</div>
<div class="mb-3">
    <label class="form-label">Contact Number</label>
    <input type="text" name="contact_number" class="form-control" placeholder="Contact Number" value="{{ $farmer->contact_number ?? '' }}" />
</div>
<div class="mb-3">
    <label class="form-label">Barangay</label>
    <input type="text" name="barangay" class="form-control" placeholder="Barangay" value="{{ $farmer->barangay ?? '' }}" />
</div>
<div class="mb-3">
    <label class="form-label">Photo</label>
    <input type="file" name="photo" class="form-control" />
</div>