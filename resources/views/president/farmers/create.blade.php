@extends('layouts.app', ['page_title' => 'Create new Farmer'])
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Create Farmer</h5>
                    <h5 class="card-subtitle text-muted d-flex align-items-center">Farmer Information</h5>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('president/farmers') }}" enctype="multipart/form-data">
                    @csrf
                    @include('president.farmers.form')
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('president/farmers') }}" class="btn btn-outline-danger">Cancel</a> &nbsp;
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\President\FarmerRequest') !!}
<script>
$(document).ready(function () {
    
});
</script>
@endpush