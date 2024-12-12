@extends('layouts.app', ['page_title' => 'Reports'])
@section('content')
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0">Land Report</h5>
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <div class="text-end" style="width: 80%">
                            <form action="{{ url('president/reports/lands') }}" method="get" class="d-flex justify-cotent-end">
                                <div class="input-group mb-3" style="margin-right: 10px">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar" id="date-icon"></i>
                                    </span>
                                    <input type="text" class="form-control" id="daterange" name="daterange" placeholder="Date" value="{{ $daterange ?? '' }}" />
                                </div>
                                <div style="width: 250px; margin-left: 10px">
                                    <button class="btn btn-primary">Generate Report</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="what" id="what" value="{{ $_GET['what'] ?? '' }}" />
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="list-tab" data-bs-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true">List Report</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="chart-tab" data-bs-toggle="tab" href="#chart-count" role="tab" aria-controls="chart" aria-selected="false">Crop Count Chart Report</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="chart-tab" data-bs-toggle="tab" href="#chart-yield" role="tab" aria-controls="chart" aria-selected="false">Crop Yield Chart Report</a>
                    </li>
                </ul>
            
                <!-- Tab content -->
                <div class="tab-content" id="myTabContent" style="margin-top: 20px">
                    <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                        {!! $dataTable->table() !!}
                    </div>
                    <div class="tab-pane fade" id="chart-count" role="tabpanel" aria-labelledby="chart-tab">
                        <div>
                            <h2>Total Crop Count</h2>
                            <a href="javascript:;" class="btn btn-secondary" id="printBtn">Print</a>
                        </div>
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
                    <div class="tab-pane fade" id="chart-yield" role="tabpanel" aria-labelledby="chart-tab">
                        <div>
                            <h2>Total Yield Count</h2>
                        </div>
                        <a href="javascript:;" class="btn btn-secondary" id="printBtn2">Print</a>
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
                        <canvas id="myChartYield"></canvas>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
$(document).ready(function () {
    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {}

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
        url: "{{ url('president/reports/lands/create') }}?what=crop",
        dataType: "json",
        success: function (response) {
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.data[0],
                    datasets: [
                        {
                            label: 'Rice',
                            data: response.data[1],
                            borderWidth: 1,
                            backgroundColor: 'rgba(255, 99, 132, 1)'
                        },
                        {
                            label: 'Corn',
                            data: response.data[2],
                            borderWidth: 1,
                            backgroundColor: 'rgba(255, 255, 0, 1)'
                        },
                    ]
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

    $('#month').change(function (e) {
        if (myChart) {
            myChart.destroy();
        }

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ url('president/reports/lands') }}",
            data: {
                month: $(this).val(),
                what: 'crop'
            },
            dataType: "json",
            success: function (response) {
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: response.data[0],
                        datasets: [
                            {
                                label: 'Rice',
                                data: response.data[1],
                                borderWidth: 1,
                                backgroundColor: 'rgba(255, 99, 132, 1)'
                            },
                            {
                                label: 'Corn',
                                data: response.data[2],
                                borderWidth: 1,
                                backgroundColor: 'rgba(255, 255, 0, 1)'
                            },
                        ]
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

    const ctx2 = document.getElementById('myChartYield').getContext('2d');
    let myChartYield;

    $.ajax({
        type: "GET",
        url: "{{ url('president/reports/lands/create') }}?what=yield",
        dataType: "json",
        success: function (response) {
            myChartYield = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: response.data[0],
                    datasets: [
                        {
                            label: 'Rice',
                            data: response.data[1],
                            borderWidth: 1,
                            backgroundColor: 'rgba(255, 99, 132, 1)'
                        },
                        {
                            label: 'Corn',
                            data: response.data[2],
                            borderWidth: 1,
                            backgroundColor: 'rgba(255, 255, 0, 1)'
                        },
                    ]
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

    $('#month').change(function (e) {
        if (myChartYield) {
            myChartYield.destroy();
        }

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ url('president/reports/lands') }}",
            data: {
                month: $(this).val(),
                what: 'yield'
            },
            dataType: "json",
            success: function (response) {
                myChartYield = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: response.data[0],
                        datasets: [
                            {
                                label: 'Rice',
                                data: response.data[1],
                                borderWidth: 1,
                                backgroundColor: 'rgba(255, 99, 132, 1)'
                            },
                            {
                                label: 'Corn',
                                data: response.data[2],
                                borderWidth: 1,
                                backgroundColor: 'rgba(255, 255, 0, 1)'
                            },
                        ]
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

document.getElementById('printBtn').addEventListener('click', function() {
    html2canvas(document.getElementById('myChart')).then(function(canvas) {
        const imgData = canvas.toDataURL('image/png');

        // Create an iframe for printing
        const iframe = document.createElement('iframe');
        iframe.style.position = 'absolute';
        iframe.style.width = '0';
        iframe.style.height = '0';
        iframe.style.border = 'none';
        document.body.appendChild(iframe);

        const doc = iframe.contentWindow.document;
        doc.open();
        doc.write('<html><head><title>Total Crop Count</title></head><body>');
        doc.write('<img src="' + imgData + '" style="width:100%;"/>');
        doc.write('</body></html>');
        doc.close();

        // Wait for the iframe to load before printing
        iframe.contentWindow.onload = function() {
            iframe.contentWindow.print();
            document.body.removeChild(iframe); // Clean up the iframe after printing
        };
    }).catch(function(error) {
        console.error('Error capturing the chart:', error);
    });
});

document.getElementById('printBtn2').addEventListener('click', function() {
    html2canvas(document.getElementById('myChartYield')).then(function(canvas) {
        const imgData = canvas.toDataURL('image/png');

        // Create an iframe for printing
        const iframe = document.createElement('iframe');
        iframe.style.position = 'absolute';
        iframe.style.width = '0';
        iframe.style.height = '0';
        iframe.style.border = 'none';
        document.body.appendChild(iframe);

        const doc = iframe.contentWindow.document;
        doc.open();
        doc.write('<html><head><title>Total Yield Count</title></head><body>');
        doc.write('<img src="' + imgData + '" style="width:100%;"/>');
        doc.write('</body></html>');
        doc.close();

        // Wait for the iframe to load before printing
        iframe.contentWindow.onload = function() {
            iframe.contentWindow.print();
            document.body.removeChild(iframe); // Clean up the iframe after printing
        };
    }).catch(function(error) {
        console.error('Error capturing the chart:', error);
    });
});
</script>
@endpush