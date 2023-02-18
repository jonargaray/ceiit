<option value="">--</option>
@forelse ($cities as $city)
	<option value="{{ $city->city_id }}">{{ ucwords(strtolower($city->city)) }}</option>
@empty
@endforelse