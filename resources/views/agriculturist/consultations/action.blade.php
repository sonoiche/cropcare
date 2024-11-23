{{-- <div class="btn-group">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu" style="">
        <a class="dropdown-item text-black-50" href="{{ url('president/consultations', $id) }}/edit">Edit</a>
        <a class="dropdown-item text-black-50" href="javascript:;" onclick="removeConsultation({{ $id }})">Delete</a>
    </div>
</div> --}}
@if ($consultation->status != 'Resolve')
<a class="btn btn-primary" href="javascript:;" onclick="resolveConsultation({{ $consultation->id }})">
    Mark as Resolve
</a>
@endif