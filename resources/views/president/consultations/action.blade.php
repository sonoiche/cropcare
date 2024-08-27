@if($consultation->status !== 'Resolve')
<div class="btn-group">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu" style="">
        <a class="dropdown-item text-black-50" href="{{ url('president/consultations', $consultation->id) }}/edit">Edit</a>
        <a class="dropdown-item text-black-50" href="javascript:;" onclick="removeConsultation({{ $consultation->id }})">Delete</a>
    </div>
</div>
@endif
@if($consultation->status === 'Resolve')
<a href="{{ url('president/geographics/create') }}?consultation_id={{ $consultation->id }}" class="btn btn-outline-primary">Add to GIS</a>
@endif