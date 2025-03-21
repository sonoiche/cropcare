@extends('layouts.app', ['page_title' => 'GIS'])
@section('content')
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">Geographic Information System</h5>
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
function removeGeographic(id) {
    if(confirm('Are you sure you want to delete this gis?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('president/geographics') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush