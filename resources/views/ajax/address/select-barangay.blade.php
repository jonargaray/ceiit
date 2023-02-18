<option value="">--</option>
@forelse ($barangays as $barangay)
	<option  value="{{ $barangay->barangay_id }}">{{  ucwords(strtolower($barangay->barangay)) }}</option>
@empty
@endforelse