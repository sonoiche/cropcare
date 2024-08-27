@extends('layouts.app', ['page_title' => 'Add new Consultation'])
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Add new Consultation</h5>
                    <h5 class="card-subtitle text-muted d-flex align-items-center">Constultation</h5>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('president/consultations') }}" enctype="multipart/form-data">
                    @csrf
                    @include('president.consultations.form')
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('president/consultations') }}" class="btn btn-outline-danger">Cancel</a> &nbsp;
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\President\ConsultationRequest') !!}
<script>
$(document).ready(function () {
    
});
</script>
@endpush