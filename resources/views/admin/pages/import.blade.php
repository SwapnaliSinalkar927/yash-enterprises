@extends('admin.main')

@section('title', 'Import')

@section('style')
<style>
label {
    font-weight: 700 !important;
    font-size: 13px !important;
    margin-bottom: 0.3rem;
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
                    <form action="{{ route('admin.imports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-8 mb-md-4 mb-3">
                            <div class="card card-shadow mb-0 h-100">
                                <div class="card-header card-header-action">
                                    <h4>Import</h4>
                                </div>
                                <div class="card-body">
                                    <label for="table">Tables.:</label>
                                    <select name="table" id="table" class="form-select select2" required="">
                                        <option value="">-- Select Tables --</option>
                                        @foreach($tables as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('table')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="mb-3 mt-3">
                                        <label for="formFile" class="col-md-3 col-form-label">Upload File: <span
                                                class="required">*</span></label>
                                        <input class="form-control" type="file" name="file" required accept=".csv">
                                        @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <small>Download a <a id="csv" href="">sample CSV template</a> to see an example
                                            of the format required.</small>
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
    <script>
        $('#table').on('change', function() {
            var table = this.value;

            csv_file_path = "{{ asset('sample_csv/') }}/" + table + ".csv";

            document.getElementById("csv").href = csv_file_path;
        });
    </script>
@endsection