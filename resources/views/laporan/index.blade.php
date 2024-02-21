@extends('layouts.template')

@section('content')
    <div class="justify-content-center align-items-center text-center mt-5 mr-5">
        <div class="col-lg-10 float-right">
            <div class="card">
                <div class="card-header">
                    <h3>Transaksi Masuk</h3>
                    {{-- <hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="">Tanggal Awal</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="">Tanggal Akhir</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary form-control mt-4">Filter</button>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <td>No.Transaksi</td>
                                    <td>Tanggal Transaksi</td>
                                    <td>Total Income</td>
                                    <td>Nama Kasir</td>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($transaksis as $item)
                                    <tr>
                                        <td>{{ $item->no_transaksi }}</td>
                                        <td>{{ $item->tgl_transaksi }}</td>
                                        <td>{{ number_format($item->total_bayar, 2, ',', '.') }}</td>
                                        <td>{{ $item->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Grapik Omset</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="chart-container">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#dataTable').dataTable()
            
            var myBarChart = new Chart(barChart, {
			type: 'bar',
			data: {
				labels: {!! json_encode($labels) !!},
				datasets : [{
					label: "Income",
					backgroundColor: '#529ec2',
					borderColor: 'rgb(23, 125, 255)',
					data: {!! json_encode($values) !!},
				}],
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				},
			}
        })
        })
    </script>
@endsection
