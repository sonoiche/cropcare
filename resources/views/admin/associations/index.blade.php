@extends('layouts.app', ['page_title' => 'Manage Associations'])
@section('content')
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title mb-0">List of Associations</h5>
                    <div class="d-flex align-items-center">
                        <a href="{{ url('admin/associations/create') }}" class="btn btn-outline-primary">Create Association</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! $dataTable->table() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
function removeAssociation(id) {
    if(confirm('Are you sure you want to delete this association?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/associations') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush