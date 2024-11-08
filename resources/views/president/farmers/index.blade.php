@extends('layouts.app', ['page_title' => 'Manage Farmers'])
@section('content')
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">List of Farmers</h5>
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
function removeFarmer(id) {
    if(confirm('Are you sure you want to delete this farmer?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('president/farmers') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush