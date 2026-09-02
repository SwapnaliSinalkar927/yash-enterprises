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
                <form action="{{ route('admin.wds.update',$wd->id) }}" method="POST" class="needs-validation" novalidate>
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
                                                    value="{{ old('code') ?? $wd->code }}" id="code" name="code" required>
                                                @error('code')
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
                                                <label for="frimn_name">Firm Name.:</label>
                                                <input type="text"
                                                    class="form-control @error('firm_name') is-invalid @enderror"
                                                    value="{{ old('firm_name') ?? $wd->firm_name }}" id="firm_name" name="firm_name" required>
                                                @error('firm_name')
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
                                                <label for="tb">TB.:</label>
                                                <input type="text"
                                                    class="form-control @error('tb') is-invalid @enderror"
                                                    value="{{ old('tb') ?? $wd->tb }}" id="tb" name="tb" required>
                                                @error('tb')
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
                                                <label for="area">location.:</label>
                                                <input type="text"
                                                    class="form-control @error('location') is-invalid @enderror"
                                                    value="{{ old('location') ?? $wd->location }}" id="location" name="location" required>
                                                @error('location')
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
                                                <option value="1" {{ old('status')== "1" || $wd->status == "1" ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status')== "0" || $wd->status == "0" ? 'selected' : '' }}>Inactive</option>
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