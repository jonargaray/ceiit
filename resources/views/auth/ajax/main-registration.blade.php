<div class="form-group row"><label class="col-sm-3 col-form-label">Business Name <span class="text-danger pull-right">*</span></label>
    <div class="col-sm-6">
        <input id="email" type="text" autocomplete="nope" class="form-control  @error('business_name') is-invalid @enderror" placeholder="Bakeshop" name="business_name" required="" value="{{ old('business_name') }}"  autofocus>
        @error('business_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row"><label class="col-sm-3 col-form-label">Province <span class="text-danger pull-right">*</span></label>
    <div class="col-sm-6">
        <select name="province_id" class="form-control @error('province_id') error @enderror" onchange="loadElement('/city/'+this.value, 'city_id')" required="">
            <option value="">--</option>
            @forelse($provinces as $province)
                <option value="{{$province->province_id}}" {{$province->province_id == old('province_id') ? 'selected' : ''}}>{{ ucwords(strtolower($province->province)) }}</option>
            @empty
            @endforelse
        </select>
        @error('province_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row"><label class="col-sm-3 col-form-label">City/Municipality <span class="text-danger pull-right">*</span></label>
    <div class="col-sm-6">
        <select name="city_id" id="city_id" class="form-control @error('city_id') error @enderror" onchange="loadElement('/barangay/'+this.value, 'barangay_id')" required="">
            <option value="">--</option>
        </select>
        @error('city_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row"><label class="col-sm-3 col-form-label">Barangay <span class="text-danger pull-right">*</span></label>
    <div class="col-sm-6">
        <select name="barangay_id" id="barangay_id" class="form-control @error('barangay_id') error @enderror" required="">
            <option value="">--</option>
        </select>
        @error('province_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

