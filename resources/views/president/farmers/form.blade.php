<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="fname" class="form-control" placeholder="First Name" value="{{ $farmer->fname ?? '' }}" />
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="lname" class="form-control" placeholder="Last Name" value="{{ $farmer->lname ?? '' }}" />
        </div>
    </div>
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