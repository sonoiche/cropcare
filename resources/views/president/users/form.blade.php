<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="fname" class="form-control" placeholder="First Name" value="{{ $user->fname ?? '' }}" />
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="lname" class="form-control" placeholder="Last Name" value="{{ $user->lname ?? '' }}" />
        </div>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Email Address</label>
    <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ $user->email ?? '' }}" />
</div>
<div class="mb-3">
    <label class="form-label">Contact Number</label>
    <input type="text" name="contact_number" class="form-control" placeholder="Contact Number" value="{{ $user->contact_number ?? '' }}" />
</div>
<div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" />
</div>
<div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" />
</div>
<div id="president-content">
    <div class="mb-3">
        <label class="form-label">Barangay</label>
        <input type="text" id="barangay" class="form-control" placeholder="Barangay" value="{{ $user->barangay ?? '' }}" readonly />
    </div>
    <div class="mb-3">
        <label class="form-label">Association</label>
        <select id="association_id" class="form-select" disabled>
            <option value="">Select Association</option>
            @foreach ($associations as $association)
            <option value="{{ $association->id }}" {{ (isset($user->association_id) && $user->association_id == $association->id) ? 'selected' : '' }}>{{ $association->name }}</option>
            @endforeach
        </select>
    </div>
</div>