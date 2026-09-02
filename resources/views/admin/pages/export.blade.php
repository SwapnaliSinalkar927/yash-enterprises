@extends('admin.main')

@section('title', 'Export')

@section('style')
<link href="{{ asset('admin/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
label {
    font-weight: 700;
    font-size: 13px !important;
    margin-bottom: 0.3rem;
}

.quantity-checkbox,
.pincode-checkbox,
.city-checkbox,
.state-checkbox,
.filter_section {
    display: none;
}

.quantity-checkbox,
.pincode-checkbox,
.city-checkbox,
.state-checkbox {
    margin-right: 20px;
}

.filter-section {
    display: flex;
    flex-direction: row;
}

.filter-label {
    font-weight: 700;
    margin-right: 20px;
}

.form-check-label {
    font-weight: 400;
}

@media screen and (max-width: 480px) {
    .filter-section {
        display: flex;
        flex-direction: row !important;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }
}
.payment-method-field{
    display: none;
}
</style>
@endsection

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-fluid p-5 pb-0">
            <div class="hk-pg-body">
                <div class="tab-pane fade show active" id="tab_block_1">
                    <div class="row mb-3">
                        <div class="col-md-12" id="error_section">
                            @if(\Session::get('status') == 'failed')
                                @include('admin.components.server-alert', ['status' => \Session::get('status')])
                            @endif
                            @if(\Session::get('status') == 'success')
                                @include('admin.components.server-alert', ['status' => \Session::get('status')])
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <form action="{{ route('admin.exports.data') }}" method="POST">
                            @csrf
                            <div class="col-md-8 mb-md-4 mb-3">
                                <div class="card card-shadow mb-0 h-100">
                                    <div class="card-header card-header-action">
                                        <h4>Export</h4>
                                    </div>
                                    <div class="card-body">
                                        <label for="table">Tables.:</label>
                                        <select name="table" id="table" class="form-select select2 mb-3" required="">
                                            <option value="">-- Select Tables --</option>
                                            @can('old_exporaccess')
                                                @foreach($data['tables'] as $table)
                                                <option value="{{ $table }}" {{ old('table')==$table ? 'selected' : '' }}>
                                                    {{ camel_case_to_string($table) }}</option>
                                                @endforeach
                                            @endcan
                                            <option value="latest_codes">Latest Code</option>
                                            <option value="latest_wholesalers">Latest Wholesaler</option>
                                            <option value="latest_orders">Latest Order</option>
                                        </select>

                                        <div id="additional-fields" class="mt-3"></div>
                                        {{-- <div class="row payment-method-field">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="payment_method">Select Payment Method.:</label>
                                                    <select name="payment_method" id="payment_method" class="form-select @error('payment_method') is-invalid @enderror mb-3">
                                                        <option value="">--Select Payment Method--</option>
                                                        <option value="upi">UPI</option>
                                                        <option value="bank_transfer">Bank Transfer</option>
                                                    </select>
                                                    @error('payment_method')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="brandName">Select Start Date and Time.:</label>
                                                    <input type="text" id="startDateTime" class="form-control" name="startDateTime" placeholder="Start Date and Time" ng-model="UIcontroller.JobDataModel.datetime">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="brandName">Select End Date and Time.:</label>
                                                    <input type="text" id="startDateTime" class="form-control" name="endDateTime" placeholder="End Date and Time" ng-model="UIcontroller.JobDataModel.datetime">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <input type="submit" id="btnSubmit"
                                    style="z-index: 9;margin-right: 20px;margin-bottom: 20px;" name="btnSubmit"
                                    value="Submit" class="btn btn-success float-right">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
<script src="{{ asset('admin/js/bootstrap-datepicker.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#startDateTime", {
        enableTime: true,
        time_24hr: true,
        enableSeconds: true,
        dateFormat: "Y-m-d H:i:S", // Customize the date format as needed
    });

    $(document).ready(function() {
        $('#table').on('change', function() {
            if ($(this).val() === 'wholesaler_rzp_upload') {
                $('.payment-method-field').css('display', 'block');
            } else {
                $('.payment-method-field').css('display', 'none');
            }
        });

        // Trigger change event on page load in case the select already has a value
        $('#table').trigger('change');
    });


</script>
@endsection
