@extends('layouts.app', ['page_title' => 'GIS'])
@section('content')
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <form method="get">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Geographic Information System</h5>
                        <div class="input-group" style="width: 30%">
                            <select name="president_id" id="president_id" class="form-select" style="width: 10%">
                                <option value="">All Presidents</option>
                                @foreach ($presidents as $president)
                                <option value="{{ $president->id }}" {{ (isset($_GET['president_id']) && $_GET['president_id'] == $president->id) ? 'selected' : '' }}>{{ $president->fullname ?? '' }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary" type="submit">Generate</button>
                        </div>
                    </div>
                </form>
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