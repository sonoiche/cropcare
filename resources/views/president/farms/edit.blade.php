@extends('layouts.app', ['page_title' => 'Update Farm Land'])
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Update Farm Land</h5>
                    <h5 class="card-subtitle text-muted d-flex align-items-center">Land Information</h5>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('president/farms', $farm->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('president.farms.form')
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('president/farms') }}" class="btn btn-outline-danger">Cancel</a> &nbsp;
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\President\FarmLandRequest') !!}
<script>
$(document).ready(function () {
    
});
</script>
@endpush