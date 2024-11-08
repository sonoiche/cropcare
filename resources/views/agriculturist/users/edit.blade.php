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
                <form method="POST" action="{{ url('agriculturist/users', $user->id) }}">
                    @csrf
                    @method('PUT')
                    @include('agriculturist.users.form')
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <input type="hidden" name="id" value="{{ $user->id }}" />
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\President\UserRequest') !!}
@endpush