@extends('layouts.app', ['page_title' => 'Update Farmer'])
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Update Farmer</h5>
                    <h5 class="card-subtitle text-muted d-flex align-items-center">Farmer Information</h5>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('president/farmers', $farmer->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('president.farmers.form')
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('president/farmers') }}" class="btn btn-outline-danger">Cancel</a> &nbsp;
                        <button type="submit" class="btn btn-primary">Save Changes</button>
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