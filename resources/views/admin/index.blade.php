@extends('layouts.template')

@section('content')
    <div class="text-center mt-5">
        <h1 class="text-bold" style="font-size: 30px">Log Aktifitas</h1>
    </div>
    <div class="justify-content-center align-items-center mt-5 ml--5 mr-5">
        <div class="float-right col-lg-10">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('logs.filter') }}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="ml-1">Pilih Tanggal</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="date" name="filter" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary btn-rounded">
                                            <span class="ml-3 mr-3">Filter</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width: 20px">No</th>
                                <th>Username</th>
                                <th>Waktu</th>
                                <th>Aktifitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $log->user->name ?? '-' }}</td>
                                    <td>{{ $log->waktu->format('d-M-Y h:i') }}</td>
                                    <td>{{ $log->aktifitas }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#dataTable').DataTable();
        })
    </script>
@endsection
