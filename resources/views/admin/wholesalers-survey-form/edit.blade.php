@extends('admin.main')

@section('title', 'Edit Wholesaler')

@section('style')
<style>
    label,
    .status-title {
        font-weight: 700 !important;
        font-size: 13px !important;
        margin-bottom: 0.3rem;
    }
</style>
@endsection

@section('content')
<div class="hk-pg-wrapper">
    <div class="container-fluid p-5 pb-0">
        <h4 class="mb-sm-0 font-size-18">
            Edit Wholesaler
        </h4>
        <div class="hk-pg-body mt-2">
            <div class="tab-pane fade show active" id="tab_block_1">
                <form action="{{ route('admin.wholesalers-survey-form.show', 1) }}" method="POST"
                    class="needs-validation" novalidate>
                    <!-- @csrf -->
                    <!-- @method('PUT') -->
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-wth-line">
                                        <div class="card-line bg-primary"></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="name">Name.:</label>
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            value="{{ old('name') ?? $wholesaler->full_name }}"
                                                            id="name" name="name" required>
                                                        @error('name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="mobile_number">Mobile Number.:</label>
                                                        <input type="text"
                                                            class="form-control @error('mobile_number') is-invalid @enderror"
                                                            value="{{ old('mobile_number') ?? $wholesaler->mobile_number }}"
                                                            id="mobile_number" name="mobile_number" required>
                                                        @error('mobile_number')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="wd_code">WD Code.:</label>
                                                        <select name="wd_id" id="wd_id"
                                                            class="form-select @error('wd_id') is-invalid @enderror js-example-basic-single">
                                                            <option value="">--Select WD--</option>
                                                            @forelse($wds as $wd)
                                                                <option value="{{ $wd->id }}" {{ old('wd_id') == $wd->id || $wholesaler->wd_id == $wd->id ? 'selected' : '' }}>
                                                                    {{ $wd->code }}
                                                                </option>
                                                            @empty
                                                                <p>No WD data</p>
                                                            @endforelse
                                                        </select>
                                                        @error('wd_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-wth-line">
                                        <div class="card-line bg-warning"></div>
                                        <div class="card-body">
                                            <h4>Location Details</h4>
                                            <h5 class="card-title status-title mt-3">State:</h5>
                                            <select name="state_id" id="state_id"
                                                class="form-select @error('state_id') is-invalid @enderror js-example-basic-single">
                                                <option value="">--Select State--</option>
                                                @forelse($states as $state)
                                                    <option value="{{ $state->id }}" {{ old('state_id') == $state->id || $wholesaler->state_id == $state->id ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                @empty
                                                    <p>No state data</p>
                                                @endforelse
                                            </select>
                                            @error('state_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <h5 class="card-title status-title mt-3">City:</h5>
                                            <select name="city_id" id="city_id"
                                                class="form-select @error('city_id') is-invalid @enderror js-example-basic-single">
                                                <option value="">--Select City--</option>
                                                @forelse($cities as $city)
                                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id || $wholesaler->city_id == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @empty
                                                    <p>No state data</p>
                                                @endforelse
                                            </select>
                                            @error('city_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <h5 class="card-title status-title mt-3">Pincode:</h5>
                                            <select name="pincode_id" id="pincode_id"
                                                class="form-select @error('pincode_id') is-invalid @enderror">
                                                <option value="">--Select Pincode--</option>
                                                @forelse($pincodes as $pincode)
                                                    <option value="{{ $pincode->id }}" {{ $wholesaler->pincode_id == $pincode->id || old('pincode_id') == $pincode->id ? 'selected' : '' }}>
                                                        {{ $pincode->code }}
                                                    </option>
                                                @empty
                                                    <p>No state data</p>
                                                @endforelse
                                            </select>
                                            @error('pincode_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="card-footer text-muted">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card card-wth-line">
                                        <div class="card-line bg-warning"></div>
                                        <div class="card-body">
                                            <h5 class="card-title status-title">Status:</h5>
                                            <select name="status" id="activeStatus" class="form-select">
                                                <option value="1" {{ old('status') == "1" || $wholesaler->status == "1" ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status') == "0" || $wholesaler->status == "0" ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="card-footer text-muted">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-rounded" style="float:right;">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @endsection

    @section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            var oldCityId = "{{ old('city_id') }}";
            var oldPincodeId = "{{ old('pincode_id') }}";

            // Fetch cities based on selected state
            $('#state_id').on('change', function () {
                var stateID = $(this).val();
                if (stateID) {
                    loadCities(stateID, null);
                } else {
                    $('#city_id').empty().append('<option value="">--Select City--</option>');
                }
            });

            function loadCities(stateID, selectedCityId) {
                $.ajax({
                    url: '{{ route('admin.get.cities', ':state_id') }}'.replace(':state_id', stateID),
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#city_id').empty();
                        $('#city_id').empty().append('<option value="">--Select City--</option>');
                        $.each(data, function (key, value) {
                            var selected = (key == oldCityId) ? 'selected' : '';  // Check if the key matches oldCityId
                            $('#city_id').append('<option value="' + key + '" ' + selected + '>' + value + '</option>');
                        });

                        // If there's an old city value, set it
                        if (selectedCityId) {
                            $('#city_id').val(selectedCityId);
                        }
                    }
                });
            }

            // Fetch pincodes based on selected city
            $('#city_id').on('change', function () {
                var cityID = $(this).val();
                if (cityID) {
                    loadPincodes(cityID, null);
                } else {
                    $('#pincode_id').empty().append('<option value="">--Select Pincode--</option>');
                }
            });

            function loadPincodes(cityID, selectedPincodeId) {
                $.ajax({
                    url: '{{ route('admin.get.pincodes', ':city_id') }}'.replace(':city_id', cityID),
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#pincode_id').empty();
                        $('#pincode_id').empty().append('<option value="">--Select Pincode--</option>');
                        $.each(data, function (index, pincode) {
                            console.log(pincode.id, pincode.code, pincode.area);

                            var selected = (pincode.id == selectedPincodeId) ? 'selected' : ''; // Check if the id matches selectedPincodeId
                            var displayText = pincode.code; // Format: code (area)

                            $('#pincode_id').append('<option value="' + pincode.id + '" ' + selected + '>' + displayText + '</option>');
                        });

                        // If there's an old city value, set it
                        if (selectedPincodeId) {
                            $('#city_id').val(selectedPincodeId);
                        }
                    }
                });
            }
            // Show the appropriate fields based on the selected payment method
            $('input[name="payment_method"]').change(function () {
                if ($(this).val() === 'UPI') {
                    // Show UPI field, hide Bank Transfer fields with animation
                    $('.upi-fields').slideDown();
                    $('.bank-transfer-fields').slideUp();

                    // Make UPI field required and remove required from bank fields
                    $('#upi_id').prop('required', true);
                    $('#ifsc_code, #account_number, #account_holder_name').prop('required', false);
                } else if ($(this).val() === 'Bank Transfer') {
                    // Show Bank Transfer fields, hide UPI field with animation
                    $('.upi-fields').slideUp();
                    $('.bank-transfer-fields').slideDown();

                    // Make Bank Transfer fields required and remove required from UPI field
                    $('#upi_id').prop('required', false);
                    $('#ifsc_code, #account_number, #account_holder_name').prop('required', true);
                }
            });

            // Trigger change event to set the correct visibility on page load (if old values exist)
            $('input[name="payment_method"]:checked').trigger('change');
        });
    </script>
    @endsection