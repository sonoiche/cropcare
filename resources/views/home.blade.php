@extends('layouts.app', ['page_title' => 'Dashboard'])
@section('content')
<div class="row">
    <div class="col-xl-12 col-xxl-12 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">{{ auth()->user()->role !== 'Admin' ? 'Tenant Lands' : 'Tenant Lands' }}</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="map"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $availableLands }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Owned Lands</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="star"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $ownedLands }}</h1>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->role === 'President')
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Total Crops Yield</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="map"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $totalCropsYield }}</h1>
                        </div>
                    </div>
                </div>
                @endif
                @if (auth()->user()->role === 'Admin')
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Registered Active Users</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $userCount }}</h1>
                        </div>
                    </div>
                </div>
                @endif
                @if (auth()->user()->role === 'President')
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Registered Farmers</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $farmerCount }}</h1>
                        </div>
                    </div>
                </div>
                @endif
                @if (auth()->user()->role === 'Agriculturist')
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Active Consultations</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="folder"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $consultationCount }}</h1>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('widgets.home.' . strtolower(auth()->user()->role))
@endsection

@push('scripts')
<script>
    // document.addEventListener("DOMContentLoaded", function () {
    //     var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
    //     var gradient = ctx.createLinearGradient(0, 0, 0, 225);
    //     gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
    //     gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
    //     // Line chart
    //     new Chart(document.getElementById("chartjs-dashboard-line"), {
    //         type: "line",
    //         data: {
    //             labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    //             datasets: [
    //                 {
    //                     label: "Sales ($)",
    //                     fill: true,
    //                     backgroundColor: gradient,
    //                     borderColor: window.theme.primary,
    //                     data: [2115, 1562, 1584, 1892, 1587, 1923, 2566, 2448, 2805, 3438, 2917, 3327],
    //                 },
    //             ],
    //         },
    //         options: {
    //             maintainAspectRatio: false,
    //             legend: {
    //                 display: false,
    //             },
    //             tooltips: {
    //                 intersect: false,
    //             },
    //             hover: {
    //                 intersect: true,
    //             },
    //             plugins: {
    //                 filler: {
    //                     propagate: false,
    //                 },
    //             },
    //             scales: {
    //                 xAxes: [
    //                     {
    //                         reverse: true,
    //                         gridLines: {
    //                             color: "rgba(0,0,0,0.0)",
    //                         },
    //                     },
    //                 ],
    //                 yAxes: [
    //                     {
    //                         ticks: {
    //                             stepSize: 1000,
    //                         },
    //                         display: true,
    //                         borderDash: [3, 3],
    //                         gridLines: {
    //                             color: "rgba(0,0,0,0.0)",
    //                         },
    //                     },
    //                 ],
    //             },
    //         },
    //     });
    // });
    
    // document.addEventListener("DOMContentLoaded", function () {
    //     // Pie chart
    //     new Chart(document.getElementById("chartjs-dashboard-pie"), {
    //         type: "pie",
    //         data: {
    //             labels: ["Chrome", "Firefox", "IE"],
    //             datasets: [
    //                 {
    //                     data: [4306, 3801, 1689],
    //                     backgroundColor: [window.theme.primary, window.theme.warning, window.theme.danger],
    //                     borderWidth: 5,
    //                 },
    //             ],
    //         },
    //         options: {
    //             responsive: !window.MSInputMethodContext,
    //             maintainAspectRatio: false,
    //             legend: {
    //                 display: false,
    //             },
    //             cutoutPercentage: 75,
    //         },
    //     });
    // });
    
    // document.addEventListener("DOMContentLoaded", function () {
    //     // Bar chart
    //     new Chart(document.getElementById("chartjs-dashboard-bar"), {
    //         type: "bar",
    //         data: {
    //             labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    //             datasets: [
    //                 {
    //                     label: "This year",
    //                     backgroundColor: window.theme.primary,
    //                     borderColor: window.theme.primary,
    //                     hoverBackgroundColor: window.theme.primary,
    //                     hoverBorderColor: window.theme.primary,
    //                     data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
    //                     barPercentage: 0.75,
    //                     categoryPercentage: 0.5,
    //                 },
    //             ],
    //         },
    //         options: {
    //             maintainAspectRatio: false,
    //             legend: {
    //                 display: false,
    //             },
    //             scales: {
    //                 yAxes: [
    //                     {
    //                         gridLines: {
    //                             display: false,
    //                         },
    //                         stacked: false,
    //                         ticks: {
    //                             stepSize: 20,
    //                         },
    //                     },
    //                 ],
    //                 xAxes: [
    //                     {
    //                         stacked: false,
    //                         gridLines: {
    //                             color: "transparent",
    //                         },
    //                     },
    //                 ],
    //             },
    //         },
    //     });
    // });
    
    // document.addEventListener("DOMContentLoaded", function () {
    //     var markers = [
    //         {
    //             coords: [31.230391, 121.473701],
    //             name: "Shanghai",
    //         },
    //         {
    //             coords: [28.70406, 77.102493],
    //             name: "Delhi",
    //         },
    //         {
    //             coords: [6.524379, 3.379206],
    //             name: "Lagos",
    //         },
    //         {
    //             coords: [35.689487, 139.691711],
    //             name: "Tokyo",
    //         },
    //         {
    //             coords: [23.12911, 113.264381],
    //             name: "Guangzhou",
    //         },
    //         {
    //             coords: [40.7127837, -74.0059413],
    //             name: "New York",
    //         },
    //         {
    //             coords: [34.052235, -118.243683],
    //             name: "Los Angeles",
    //         },
    //         {
    //             coords: [41.878113, -87.629799],
    //             name: "Chicago",
    //         },
    //         {
    //             coords: [51.507351, -0.127758],
    //             name: "London",
    //         },
    //         {
    //             coords: [40.416775, -3.70379],
    //             name: "Madrid ",
    //         },
    //     ];
    //     var map = new jsVectorMap({
    //         map: "world",
    //         selector: "#world_map",
    //         zoomButtons: true,
    //         markers: markers,
    //         markerStyle: {
    //             initial: {
    //                 r: 9,
    //                 strokeWidth: 7,
    //                 stokeOpacity: 0.4,
    //                 fill: window.theme.primary,
    //             },
    //             hover: {
    //                 fill: window.theme.primary,
    //                 stroke: window.theme.primary,
    //             },
    //         },
    //         zoomOnScroll: false,
    //     });
    //     window.addEventListener("resize", () => {
    //         map.updateSize();
    //     });
    // });

    // document.addEventListener("DOMContentLoaded", function () {
    //     var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
    //     var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
    //     document.getElementById("datetimepicker-dashboard").flatpickr({
    //         inline: true,
    //         prevArrow: '<span title="Previous month">&laquo;</span>',
    //         nextArrow: '<span title="Next month">&raquo;</span>',
    //         defaultDate: defaultDate,
    //     });
    // });

    function changeStatus(id, status) {
        if(confirm('Are you sure you want to ' + status + ' this?')) {
            $.ajax({
                type: "GET",
                url: "{{ url('agriculturist/consultations') }}/" + id + "?status=" + status,
                dataType: "json",
                success: function (response) {
                    $('#consultation-title').html(response.consultation.title);
                    $('#consultation-farmer').html(response.consultation.farmer_fullname);
                    $('#consultation-concern').html(response.consultation.concern);
                    $('#consultation-president').html(response.president.fullname);
                    $('#consultation-location').html(response.consultation.location);
                    $('#modal-consultation').modal('show');

                    if(status === 'Resolved') {
                        location.reload();
                    }
                }
            });
        }
    }
</script>
@endpush