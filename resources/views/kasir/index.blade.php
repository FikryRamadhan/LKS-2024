@extends('layouts.template')

@section('content')
    <div class="align-items-center justify-content-center mt-5">
        <div class="float-right col-lg-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="col-lg-10">Form Transaksi</h3>
                        <button type="hide" class="btn btn-danger ">Kasir</button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formData">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Kode Transaksi</label>
                                    <input type="text" name="kode_transaksi" class="form-control"
                                        value="{{ App\MyClass\KodeTransaksi::formatKode() }}" readonly>
                                </div>
                            </div>
                            <input type="number" name="id_user" hidden value="{{ Auth::user()->id }}">
                            <input type="number" name="total_bayar" hidden value="{{ $hargaTotal ? $hargaTotal : 0 }}">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Pilih Produk</label>
                                    <select name="id_barang" id="barang" class="form-control barang"  style="width: 100;">
                                            <option value=""></option>
                                            @foreach (App\Models\Barang::all() as $item)
                                                <option value="{{ $item->id }}" data-price="{{ $item->harga_satuan }}"
                                                    data-name-barang="{{ $item->nama_barang }}"
                                                    data-kode-barang="{{ $item->kode_barang }}">{{ $item->kode_barang }} -
                                                {{ $item->nama_barang }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Total Harga</label>
                                    <input type="number" class="form-control" id="totalHarga" name="harga_total"
                                        style="background-color: rgb(206, 205, 205);" placeholder="Harga Satuan Produk"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Harga Satuan</label>
                                    <input type="number" class="form-control" id="hargaSatyuan" name="harga_satuan"
                                        style="background-color: rgb(206, 205, 205);" placeholder="Harga Satuan Produk" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Quantitas</label>
                                    <input type="number" class="form-control" id="quantitas" name="jumlah_barang"
                                        style="background-color: rgb(206, 205, 205);" placeholder="Harga Satuan Produk"
                                        >
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="float-right mr-3">
                                    <div class="row">
                                        <div class="form-group">
                                            <button id="addKeranjang" class="btn btn-primary">Tambah
                                                Barang</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="float-left ml-3 mb-3">
                            <h3 class="card-title">Keranjang</h3>
                        </div>
                        <div class="table table-responsive">
                            <table id="dataTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Kode Transaksi</td>
                                        <td>Nama Barang</td>
                                        <td>Harga Satuan</td>
                                        <td>Quantitas</td>
                                        <td>Jumlah Harga</td>
                                        <td style="width: 20px">Aksi</td>
                                    </tr>
                                </thead>
                                @if (isset($dataBarang))
                                    <tbody>
                                        @foreach ($dataBarang as $item)
                                            <tr>
                                                <td>{{ $item->kode_transaksi }}</td>
                                                <td>{{ $item->barang->nama_barang }}</td>
                                                <td>{{ $item->formatRp($item->harga_satuan) }}</td>
                                                <td>{{ $item->jumlah_barang }}</td>
                                                <td>{{ $item->formatRp($item->harga_total) }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" data-message="Yakin ingin menghapus Barang Ini?" data-href="{{ route('transaksi.keranjang.delete', $item->id) }}" class="btn btn-danger btn-sm delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @else
                                    <tbody>

                                    </tbody>
                                @endif
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>
                                        Total Biaya Rp.
                                        <span id="totalBiaya"> {{ number_format($hargaTotal ,2,',','.') }}</span>
                                    </label>
                                    <input type="number" class="form-control" id="pembayaran"
                                        style="background-color: rgb(206, 205, 205);" placeholder="Masukan Nominal Uang">

                                    <button id="bayar" class="btn btn-primary form-control mt-2"
                                        style="width: 100%">Bayar</button>

                                    <label class="mt-2">
                                        Total Kembalian Rp.
                                        <span id="kembalian"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="float-right mr-3 mt-4">
                                    <div class="row">
                                        <div class="form-group">
                                            <button id="print" class="btn btn-primary text-light">Print</button>
                                            <button id="simpanTransaksi" class="btn btn-primary text-light">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Script Javascript --}}
    <script>
        // Function Plugin
        $(function(){
            $('#dataTable').dataTable()

            $(".barang").select2({
            placeholder: "-- Kode - Nama Barang --"
            })
        })


        // Action Menambah Data
        const $formData = $('#formData')
        const $formDataSubmitBtn = $('#formData').find('#simpanTransaksi').ladda();

        const submitBtn = ($form, $formSubmit, $url, $method) => {
            $form.off('submit');
            $form.on('submit', function(e){
                e.preventDefault();
                let data = $(this).serialize();
                $formSubmit.ladda('start');

                ajaxSetup();
                $.ajax({
                    url: $url,
                    data: data,
                    method: $method,
                    dataType: 'json'
                }).done(response => {
                    if (response.pdf) {
                        $formSubmit.ladda('stop');
                        successNotification('Berhasil', 'Akan Di Arahkan Ke Pdf');
                        let pdf = response.pdf
                        window.location.href = "storage/transaksi/"+pdf
                    } else {
                        $formSubmit.ladda('stop');
                        successNotification('Berhasil', 'Data Berhasil Disimpan')

                        window.location.reload(500);
                    }
                }).fail(error => {
                    $formSubmit.ladda('stop');
                    ajaxErrorHandling(error)
                })
            });
        }

        //  Menghapus Data Keranjang
        $(function(){
            $.each($('.delete'), (i, deleteBtn) => {
                $(deleteBtn).on('click', function(e){
                    e.preventDefault();
                    let {
                        message,
                        href
                    } = $(this).data();

                    confirmation(message, function(){
                        ajaxSetup();
                        $.ajax({
                            url: href,
                            method: 'delete',
                            dataType: 'json'
                        }).done(response => {
                            successNotification('Berhasil', 'Data Berhasil Di Hapus')
                            window.location.reload(500)
                        }).fail(error => {
                            ajaxErrorHandling(error)
                        })
                    })
                })
            })
        })

        // Untuk Menambahkan Data Detail Transaksi
        $('#addKeranjang').off('click')
        $('#addKeranjang').on('click', function(e) {
            submitBtn(
                $formData,
                $('#addKeranjang').ladda(),
                "{{ route('transaksi.keranjang') }}",
                'POST',
            )
        })

        $('#quantitas').on('input', function(){
            var  totalHarga = 0
                let hargaSatuan = $(`[name="harga_satuan"]`).val()
                let quantitas = $(`[name="jumlah_barang"]`).val()
            totalHarga = parseFloat(hargaSatuan) * parseFloat(quantitas)
            
            $('#totalHarga').val(totalHarga)
        })

        // Action Print Data
        $('#print').off('click')
        $('#print').on('click', function(e){
            submitBtn(
                $formData,
                $('#print').ladda(),
                "{{ route('transaksi.print') }}",
                'POST'
            )
        })

        // Simpan Permanen Data Transaksi
        submitBtn(
            $formData,
            $formDataSubmitBtn,
            "{{ route('transaksi.store') }}",
            'POST'
        )

        /**
         * Harga Satuan
         */
        $(function(){
            $(`[name="id_barang"]`).on('change', function(){
                let value = $(`[name="id_barang"] option:selected`).attr('data-price')
                $(`[name="harga_satuan"]`).val(value)
            })
        })

        // Mendapatkan Nilai kembalian
        function kembalian(totalHarga) {
            const btnBayar = $('#bayar')

            $(btnBayar).off('click')
            $(btnBayar).on('click', function(e){
                e.preventDefault();
                var pembayaran = $('#pembayaran').val();
                
                var kembalian = 0

                kembalian = parseInt(pembayaran) - {{ $hargaTotal }}
                
                $('#kembalian').append(kembalian)
            })
        }

        kembalian()
    </script>
@endsection
