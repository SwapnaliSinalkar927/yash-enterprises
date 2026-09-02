@extends('admin.main')

@section('title', 'Add Wholesaler')

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
            Add Wholesaler
        </h4>
        <div class="hk-pg-body mt-2">
            <div class="tab-pane fade show active" id="tab_block_1">
                <form action="{{ route('admin.wholesalers.store') }}" method="POST">
                @csrf
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
                                                        <label for="full_name">Full Name.:</label>
                                                        <input type="text"
                                                            class="form-control @error('full_name') is-invalid @enderror"
                                                            value="{{ old('full_name') }}" id="full_name" name="full_name" required>
                                                        @error('full_name')
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
                                                            value="{{ old('mobile_number') }}" id="mobile_number" name="mobile_number" required>
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
                                                        <label for="pincode">Pincode.:</label>
                                                        <input type="text"
                                                            class="form-control @error('pincode') is-invalid @enderror"
                                                            value="{{ old('pincode') }}" id="pincode" name="pincode">
                                                        @error('pincode')
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
                                            <h5 class="card-title status-title">Status:</h5>
                                            <select name="status" id="activeStatus" class="form-select">
                                                <option value="1" {{ old('status')== "1" ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status')== "0" ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="card-footer text-muted">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success btn-rounded" style="float:right;" value="Submit">
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
    </script>
@endsection