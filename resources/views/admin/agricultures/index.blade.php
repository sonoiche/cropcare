@extends('layouts.app', ['page_title' => 'Manage Users'])
@section('content')
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">List of Users</h5>
            </div>
            <div class="card-body">
                <div class="tab tab-success">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link" href="{{ url('admin/presidents') }}">Presidents</a></li>
                        <li class="nav-item"><a class="nav-link active" href="{{ url('admin/agricultures') }}">Agriculturists</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('admin/users') }}">Admin Users</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="user-1" role="tabpanel">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
function removeUser(id) {
    if(confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/users') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush