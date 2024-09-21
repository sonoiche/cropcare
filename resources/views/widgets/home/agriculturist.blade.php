<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">Latest Consultations</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Date Sent</th>
                            <th>Title</th>
                            <th>Sender</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($consultations as $key => $consultation)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $consultation->created_date }}</td>
                            <td>{{ $consultation->title }}</td>
                            <td>{{ $consultation->president->fullname ?? '' }}</td>
                            <td>{{ $consultation->location ?? '' }}</td>
                            <td>{{ $consultation->status }}</td>
                            <td class="text-center">
                                {{-- <div class="btn-group">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item text-black-50" href="{{ url('agriculturist/consultations', $consultation->id) }}?status=View">View</a>
                                        <a class="dropdown-item text-black-50" onclick="changeStatus({{ $consultation->id }}, 'Review')">Review</a>
                                        <a class="dropdown-item text-black-50" onclick="changeStatus({{ $consultation->id }}, 'Resolved')">Resolved</a>
                                    </div>
                                </div> --}}
                                <a class="btn btn-primary" href="{{ url('agriculturist/consultations', $consultation->id) }}?status=View">View Details</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-consultation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Consultation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <p style="margin-bottom: 3px">Title</p>
                <h4 id="consultation-title"></h4>
                <p style="margin-bottom: 3px">Concern / Cover Letter</p>
                <h4 id="consultation-concern"></h4>
                <p style="margin-bottom: 3px">Farmer Name</p>
                <h4 id="consultation-farmer"></h4>
                <p style="margin-bottom: 3px">President Name</p>
                <h4 id="consultation-president"></h4>
                <p style="margin-bottom: 3px">Location</p>
                <h4 id="consultation-location"></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>