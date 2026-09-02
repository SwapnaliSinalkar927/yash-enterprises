@extends('admin.main')

@section('title', 'Add City')

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
            Add City
        </h4>
        <div class="hk-pg-body mt-2">
            <div class="tab-pane fade show active" id="tab_block_1">
                <form action="{{ route('admin.cities.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card card-wth-line">
                                <div class="card-line bg-primary"></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name">Name.:</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" id="name" name="name" required>
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
                                                <label for="state_id">State Name.:</label>
                                                <select name="state_id" id="state_id" class="form-select @error('state_id') is-invalid @enderror js-example-basic-single" value="{{ old('state_id') }}">
                                                    <option value="">--Select State--</option>
                                                    @foreach($states as $state)
                                                    <option value="{{ $state->id }}" @if($state->id == old('state_id')) @endif>{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('state_id')
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