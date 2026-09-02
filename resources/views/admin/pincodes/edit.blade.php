@extends('admin.main')

@section('title', 'Edit Pincode')

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
            Edit Pincode
        </h4>
        <div class="hk-pg-body mt-2">
            <div class="tab-pane fade show active" id="tab_block_1">
                <form action="{{ route('admin.pincodes.update',$pincode->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card card-wth-line">
                                <div class="card-line bg-primary"></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="code">Code.:</label>
                                                <input type="text"
                                                    class="form-control @error('code') is-invalid @enderror"
                                                    value="{{ old('code') ?? $pincode->code }}" id="code" name="code" required>
                                                @error('code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="area">Area.:</label>
                                                <input type="text"
                                                    class="form-control @error('area') is-invalid @enderror"
                                                    value="{{ old('area') ?? $pincode->area }}" id="area" name="area" required>
                                                @error('area')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="city_id">City Name.:</label>
                                                <select name="city_id" id="city_id" class="form-select @error('city_id') is-invalid @enderror js-example-basic-single" value="{{ old('city_id') }}">
                                                    <option value="">--Select City--</option>
                                                    @foreach($cities as $city)
                                                    <option value="{{ $city->id }}" @if($city->id == old('city_id') || $city->id == $pincode->city_id)selected @endif>{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('city_id')
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
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-wth-line">
                                        <div class="card-line bg-warning"></div>
                                        <div class="card-body">
                                            <h5 class="card-title status-title">Status:</h5>
                                            <select name="status" id="activeStatus" class="form-select">
                                                <option value="1" {{ old('status')== "1" || $city->status == "1" ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status')== "0" || $city->status == "0" ? 'selected' : '' }}>Inactive</option>
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
    </script>
@endsection