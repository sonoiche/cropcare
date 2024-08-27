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
                            <td>{{ $gis->land->location ?? '' }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Latitude</td>
                            <td>{{ $gis->latitude }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Longitude</td>
                            <td>{{ $gis->longitude }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Elevation</td>
                            <td>{{ $gis->elevation }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Usage</td>
                            <td>{{ $gis->usage }}</td>
                        </tr>
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
</div>
@endsection