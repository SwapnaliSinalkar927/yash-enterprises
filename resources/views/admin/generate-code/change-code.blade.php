@extends('admin.main')

@section('title', 'Change Code Value')

@section('style')
<link href="{{ asset('admin/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <form action="{{ route('admin.store_change_code') }}" method="POST">
                            @csrf
                            <div class="col-md-8 mb-md-4 mb-3">
                                <div class="card card-shadow mb-0 h-100">
                                    <div class="card-header card-header-action">
                                        <h4>Change Code Value</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- <label for="table">Enter Code Count.:</label>
                                        <input type="text"
                                            class="form-control @error('code_count') is-invalid @enderror"
                                            value="{{ old('code_count') }}" id="code_count" name="code_count" required>
                                        @error('code_count')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror -->

                                        <label for="slug">Select WD.:</label>
                                        <select class="form-select @error('wd_id') is-invalid @enderror js-example-basic-single" id="wd_id" name="wd_id">
                                            <option value="">-- Select anyone --</option>
                                            @foreach ($wds as $wd)
                                            <option value="{{ $wd->id }}">{{ $wd->code }}</option>
                                            @endforeach
                                        </select>
                                        @error('wd_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <label for="slug" class="mt-3">Select Brand.:</label>
                                        <select class="form-select @error('brand_id') is-invalid @enderror js-example-basic-single" id="brand_id" name="brand_id">
                                            <option value="">-- Select anyone --</option>
                                            @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}({{ $brand->short_code }})</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <label for="slug" class="mt-3">Select Code.:</label>
                                        <select class="form-select @error('code_id') is-invalid @enderror js-example-basic-multiple" id="code_id" name="code_id[]" multiple="multiple">
                                            <option value="">-- Select anyone --</option>
                                        </select>
                                        @error('code_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                   
                                        <label for="table" class="mt-3">Enter Code Value.:</label>
                                        <input type="text"
                                            class="form-control @error('code_value') is-invalid @enderror"
                                            value="{{ old('code_value') }}" id="code_value" name="code_value" required>
                                            <small style="font-size: 9px;"><b>Note* : </b>Only Unused Codes Value can be Changed</small>
                                        @error('code_value')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
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
    <script>
         $(document).ready(function () {
            $('.js-example-basic-multiple').select2();

            function populateCodesDropdown(codes) {
                const select = $('#code_id');
                select.empty(); // clear existing options

                select.append('<option value="">-- Select anyone --</option>');

                codes.forEach(code => {
                    select.append(`<option value="${code.id}">${code.code}</option>`);
                });
            }

            $('#brand_id').on('change', function () {
                let brandId = $(this).val();
                let wdId = $('#wd_id').val();
                console.log(wdId,brandId);
                // return false;

                if (brandId) {
                    $.ajax({
                        url: '{{ route("admin.get-brand-ref-code") }}', 
                        type: 'GET',
                        data: {brand_id: brandId, wd_id: wdId},
                        success: function (response) {
                           populateCodesDropdown(response);
                        },
                        error: function (xhr) {
                           
                        }
                    });
                }
            });

            $('#wd_id').on('change', function () {
                let wdId = $(this).val();
                let brandId = $('#brand_id').val();
                console.log(wdId,brandId);
                // return false;

                if (wdId) {
                    $.ajax({
                        url: '{{ route("admin.get-wd-ref-code") }}', 
                        type: 'GET',
                        data: { wd_id: wdId, brand_id: brandId},
                        success: function (response) {
                           populateCodesDropdown(response);
                        },
                        error: function (xhr) {
                           
                        }
                    });
                }
            });

         
        });
    </script>
@endsection