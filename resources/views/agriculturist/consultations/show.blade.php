@extends('layouts.app', ['page_title' => 'Consultation Details'])
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Consultation Details</h5>
                    <h5 class="card-subtitle text-muted d-flex align-items-center">Consultation Details</h5>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td style="font-weight: bold">President</td>
                            <td>{{ $consultation->president->fullname ?? '' }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Farmer</td>
                            <td>{{ $consultation->farmer_fullname }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Title</td>
                            <td>{{ $consultation->title }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Message</td>
                            <td>{{ $consultation->concern }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Location</td>
                            <td>{{ $consultation->location }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ url('agriculturist/consultations') }}" class="btn btn-outline-danger">Cancel</a>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Update Consultation</h5>
                    <h5 class="card-subtitle text-muted d-flex align-items-center">Update Consultation</h5>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ url('agriculturist/consultations', $consultation->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="agriculture_id" id="agriculture_id" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Resolve">Resolve</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Schedule</label>
                                <input type="date" name="schedule" id="schedule" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection