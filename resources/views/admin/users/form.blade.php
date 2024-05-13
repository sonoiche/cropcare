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
@if (auth()->user()->role == 'Admin')
<div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role" id="role" class="form-select">
        <option value="">--</option>
        <option value="Admin" {{ (isset($user->role) && $user->role == 'Admin') ? 'selected' : '' }}>Admin</option>
        <option value="Department of Agriculture" {{ (isset($user->role) && $user->role == 'Department of Agriculture') ? 'selected' : '' }}>Department of Agriculture</option>
        <option value="President" {{ (isset($user->role) && $user->role == 'President') ? 'selected' : '' }}>President</option>
    </select>
</div>
@endif