<option value="">--</option>

@forelse ($sets as $set)
    <option value="{{ $set->id }}">{{ $set->question_set }}</option>
@empty
@endforelse