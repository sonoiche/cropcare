@extends('layouts.app', ['page_title' => 'Reports'])
@section('content')
<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0">Land Report</h5>
                </div>
                <div style="width: 30%">
                    <form action="{{ url('president/reports/lands') }}" method="get" class="d-flex justify-cotent-end">
                        <div class="input-group mb-3" style="width: 70%; margin-right: 10px">
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