<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <label class="form-label">Association Name</label>
            <input type="text" name="name" class="form-control" placeholder="Association Name" value="{{ $association->name ?? '' }}" />
        </div>
    </div>
    <div class="col-12">
        <div class="mb-3">
            <label class="form-label">President Name</label>
            <select name="president_id" id="president_id" class="form-select">
                <option value="">Select President</option>
                @foreach ($presidents as $president)
                <option value="{{ $president->id }}" {{ (isset($association->president_id) && $association->president_id == $president->id) ? 'selected' : '' }}>{{ $president->fname . ' ' . $president->lname }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>