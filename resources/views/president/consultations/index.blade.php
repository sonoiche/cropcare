@extends('layouts.app', ['page_title' => 'My Consultations'])
@section('content')
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <form method="get">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">List of Consultations</h5>
                    <div class="input-group" style="width: 30%">
                        <select name="status" id="status" class="form-select" style="width: 10%">
                            <option value="">All Status</option>
                            <option value="Accepted" {{ (isset($_GET['status']) && $_GET['status'] == 'Accepted') ? 'selected' : '' }}>Accepted</option>
                            <option value="Resolve" {{ (isset($_GET['status']) && $_GET['status'] == 'Resolve') ? 'selected' : '' }}>Resolve</option>
                        </select>
                        <button class="btn btn-primary" type="submit">Generate</button>
                    </div>
                </div>
            </form>
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