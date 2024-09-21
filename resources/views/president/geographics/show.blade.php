@extends('layouts.app', ['page_title' => $gis->name])
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">{{ $gis->name }}</h5>
                    <h5 class="card-subtitle text-muted d-flex align-items-center">GIS</h5>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td style="font-weight: bold">Name</td>
                            <td>{{ $gis->name }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Description</td>
                            <td>{{ $gis->description }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">President</td>
                            <td>{{ $gis->president->fullname ?? '' }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Association</td>
                            <td>{{ $gis->association->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Location</td>
                            <td>{{ $gis->location ?? '' }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Latitude</td>
                            <td>{{ $gis->latitude }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Longitude</td>
                            <td>{{ $gis->longitude }}</td>
                        </tr>
                        {{-- <tr>
                            <td style="font-weight: bold">Elevation</td>
                            <td>{{ $gis->elevation }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Usage</td>
                            <td>{{ $gis->usage }}</td>
                        </tr> --}}
                        <tr>
                            <td style="font-weight: bold">Remarks</td>
                            <td>{{ $gis->remarks }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ url('president/geographics') }}" class="btn btn-outline-danger">Cancel</a>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-6">
        <div id="map" style="height: 500px;"></div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_api_key') }}&callback=initMap" async defer></script>
<script>
function initMap() {
    var latitude = {{ $gis->latitude }};
    var longitude = {{ $gis->longitude }};
    var location = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

    var map = new google.maps.Map(document.getElementById('map'), {
        center: location,
        zoom: 15
    });

    var marker = new google.maps.Marker({
        map: map,
        position: location
    });

    var infowindow = new google.maps.InfoWindow({
        content: ''
    });

    google.maps.event.addListener(marker, 'mouseover', function() {
        // Set the content of the InfoWindow
        infowindow.setContent('<div>' +
            '<h5>{{ $gis->location }}</h5>' +
            '<img src="{{ $gis->photo ?? '' }}" width="100%" height="100">' +
            '</div>');
        infowindow.open(map, marker);
    });

    google.maps.event.addListener(marker, 'mouseout', function() {
        infowindow.close();
    });

    google.maps.event.addListener(marker, 'click', function() {
        // Set the content of the InfoWindow
        infowindow.setContent('<div>' +
            '<h5>{{ $gis->location }}</h5>' +
            '<img src="{{ $gis->photo ?? '' }}" width="100%" height="100">' +
            '</div>');
        infowindow.open(map, marker);
    });
}
</script>
@endpush