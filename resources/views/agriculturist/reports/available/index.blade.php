@extends('layouts.app', ['page_title' => 'Reports'])
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0">Farm Lands</h5>
                        </div>
                    </div>
                    <div class="col-md-9" style="float: right">
                        <form action="{{ url('agriculturist/reports/available-lands') }}" method="get" class="d-flex justify-cotent-end">
                            <div class="input-group mb-3" style="width: 40%; margin-right: 10px">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar" id="date-icon"></i>
                                </span>
                                <input type="text" class="form-control" id="daterange" name="daterange" placeholder="Date" value="{{ $daterange ?? '' }}" />
                            </div>
                            <div style="width: 25%; margin-right: 10px">
                                <select name="president_id" id="president_id" class="form-select">
                                    <option value="">All President</option>
                                    @foreach ($presidents as $president)
                                    <option value="{{ $president->id }}" {{ (isset($_GET['president_id']) && $_GET['president_id'] == $president->id) ? 'selected' : '' }}>{{ $president->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="width: 20%">
                                <select name="status" id="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="Tenant" {{ (isset($_GET['status']) && $_GET['status'] == 'Tenant') ? 'selected' : '' }}>Tenant</option>
                                    <option value="Owned" {{ (isset($_GET['status']) && $_GET['status'] == 'Owned') ? 'selected' : '' }}>Owned</option>
                                </select>
                            </div>
                            <div style="width: 250px; margin-left: 10px">
                                <button class="btn btn-primary">Generate Report</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! $dataTable->table() !!}
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

    // cb(start, end);
});
</script>
@endpush