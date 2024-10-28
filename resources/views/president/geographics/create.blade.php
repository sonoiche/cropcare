@extends('layouts.app', ['page_title' => 'Add to GIS'])
@section('content')
<form method="POST" action="{{ url('president/geographics') }}" enctype="multipart/form-data">
    @csrf
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
                    @include('president.geographics.form')
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('president/geographics') }}" class="btn btn-outline-danger">Cancel</a> &nbsp;
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <input type="hidden" name="consultation_id" value="{{ $consultation->id ?? '' }}" />
                </div>
            </div>        
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Location Map</h5>
                        <p>Click on the Map to Pin a Location</p>
                    </div>
                </div>
                <div class="card-body">
                    <div id="map"></div>
                    <div class="row mb-3" style="margin-top: 15px">
                        <div class="col-md-6">
                            <label class="form-label">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control" value="{{ $gis->latitude ?? '' }}" readonly />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control" value="{{ $gis->longitude ?? '' }}" readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\President\GisRequest') !!}
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_api_key') }}&callback=initMap" async defer></script>
<script>
    let map;
    let marker;

    function initMap() {
        // Initialize the map centered at a default location (e.g., New York City)
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: <?php echo $location->latitude; ?>, lng: <?php echo $location->longitude; ?> },
            zoom: 17,
        });

        // Add a click event listener to the map
        map.addListener("click", (event) => {
            placeMarker(event.latLng);
        });
    }

    function placeMarker(location) {
        // Remove the existing marker if it exists
        if (marker) {
            marker.setMap(null);
        }

        // Create a new marker at the clicked location
        marker = new google.maps.Marker({
            position: location,
            map: map,
        });

        // Get latitude and longitude
        const lat = location.lat();
        const lng = location.lng();
        $('#latitude').val(lat);
        $('#longitude').val(lng);
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