@extends('layouts.app', ['page_title' => 'Reports'])
@section('content')
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0">Consultations</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ url('agriculturist/reports/report-consultations') }}" method="get" class="d-flex justify-cotent-end">
                            <select name="type" id="type" class="form-select">
                                <option value="">All Consultations</option>
                                <option value="past" {{ (isset($_GET['type']) && $_GET['type'] == 'past') ? 'selected' : '' }}>Past Consultations</option>
                                <option value="upcoming" {{ (isset($_GET['type']) && $_GET['type'] == 'upcoming') ? 'selected' : '' }}>Upcoming Consultations</option>
                            </select>
                            <div style="width: 250px; margin-left: 10px">
                                <button class="btn btn-primary">Generate Report</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="list-tab" data-bs-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true">List Report</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="chart-tab" data-bs-toggle="tab" href="#chart" role="tab" aria-controls="chart" aria-selected="false">Chart Report</a>
                    </li>
                </ul>
            
                <!-- Tab content -->
                <div class="tab-content" id="myTabContent" style="margin-top: 20px">
                    <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                        {!! $dataTable->table() !!}
                    </div>
                    <div class="tab-pane fade" id="chart" role="tabpanel" aria-labelledby="chart-tab">
                        <div style="float: right">
                            <select name="month" id="month" class="form-select" style="width: 100%">
                                <option value="">All Months</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function () {
    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {
        // $('#daterange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    const ctx = document.getElementById('myChart').getContext('2d');
    let myChart;

    $.ajax({
        type: "GET",
        url: "{{ url('president/reports/lands/create') }}",
        dataType: "json",
        success: function (response) {
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.data[0],
                    datasets: [{
                        label: 'Rice & Corn',
                        data: response.data[1],
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });

    $('#month').change(function (e) {
        if (myChart) {
            myChart.destroy();
        }

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ url('president/reports/lands') }}",
            data: {
                month: $(this).val()
            },
            dataType: "json",
            success: function (response) {
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: response.data[0],
                        datasets: [{
                            label: 'Rice & Corn',
                            data: response.data[1],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    });
});
</script>
@endpush