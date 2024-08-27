@extends('layouts.app', ['page_title' => 'My Consultations'])
@section('content')
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">List of Consultations</h5>
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
function removeConsultation(id) {
    if(confirm('Are you sure you want to delete this consultation?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/consultations') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush