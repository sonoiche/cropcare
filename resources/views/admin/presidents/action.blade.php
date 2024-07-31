<div class="btn-group">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu" style="">
        <a class="dropdown-item text-black-50" href="{{ url('admin/users', $id) }}/edit">Edit User</a>
        <a class="dropdown-item text-black-50" href="javascript:;" onclick="removeUser({{ $id }})">Delete</a>
    </div>
</div>