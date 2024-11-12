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
                @if (isset($consultation->photo))
                    <div style="margin: 5px 0">
                        <img src="{{ $consultation->photo }}" style="width: 100%; height: 300px; object-fit: cover" />
                    </div>
                @endif
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
                @if (isset($consultation->latitude) && isset($consultation->longitude))
                <div id="map"></div>
                @endif
                <form action="{{ url('agriculturist/consultations', $consultation->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Resolve">Resolve</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Schedule</label>
                                <input type="datetime-local" name="schedule" id="schedule" class="form-control" />
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

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_api_key') }}&callback=initMap" async defer></script>
<script>
    function initMap() {
        // The location of the pin
        var location = { lat: <?php echo $consultation->latitude; ?>, lng: <?php echo $consultation->longitude; ?> };
        // The map, centered at the location
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: location
        });
        // The marker, positioned at the location
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }

    // Initialize the map
    window.onload = initMap;
</script>
@endpush

@section('css')
<style>
#map {
    height: 500px;
    width: 100%;
}
</style>
@endsection