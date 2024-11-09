@extends('layouts.app', ['page_title' => 'Manage Farmlands'])
@section('content')
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <form method="get">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">List of Farmlands</h5>
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

</script>
@endpush