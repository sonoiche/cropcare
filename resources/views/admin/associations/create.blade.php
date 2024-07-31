@extends('layouts.app', ['page_title' => 'Create new Association'])
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Create Association</h5>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('admin/associations') }}">
                    @csrf
                    @include('admin.associations.form')
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('admin/associations') }}" class="btn btn-outline-danger">Cancel</a> &nbsp;
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Admin\AssociationRequest') !!}
@endpush