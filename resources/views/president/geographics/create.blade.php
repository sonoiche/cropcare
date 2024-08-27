@extends('layouts.app', ['page_title' => 'Add to GIS'])
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Add to GIS</h5>
                    <h5 class="card-subtitle text-muted d-flex align-items-center">GIS</h5>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('president/geographics') }}" enctype="multipart/form-data">
                    @csrf
                    @include('president.geographics.form')
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('president/geographics') }}" class="btn btn-outline-danger">Cancel</a> &nbsp;
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <input type="hidden" name="consultation_id" value="{{ $consultation->id ?? '' }}" />
                </form>
            </div>
        </div>        
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\President\GisRequest') !!}
<script>
$(document).ready(function () {
    
});
</script>
@endpush