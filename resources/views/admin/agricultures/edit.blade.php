@extends('layouts.app', ['page_title' => 'Update User'])
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Update User</h5>
                    <h5 class="card-subtitle text-muted d-flex align-items-center">User Information</h5>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('admin/users', $user->id) }}">
                    @csrf
                    @method('PUT')
                    @include('admin.presidents.form')
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('admin/users') }}" class="btn btn-outline-danger">Cancel</a> &nbsp;
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Admin\UserRequest') !!}
@endpush