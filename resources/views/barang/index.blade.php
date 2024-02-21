@extends('layouts.template')

@section('content')
    <div class="align-items-center justify-content-center mt-5 ml--5 mr-5">
        <div class="float-right col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Kelola Gudang</h4>
                </div>
                <div class="card-body">
                    <form id="formData">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Kode Barang</label>
                                    <input type="text" name="kode_barang" class="form-control"
                                        style="background-color: rgb(206, 205, 205);" placeholder="Kode Barang">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Jumlah Barang</label>
                                    <input type="alamat" class="form-control" name="jumlah_barang"
                                        style="background-color: rgb(206, 205, 205);" placeholder="Jumlah Barang">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang"
                                        style="background-color: rgb(206, 205, 205);" placeholder="Nama Barang">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Satuan Product</label>
                                    <select type="text" class="form-control" name="satuan"
                                        style="background-color: rgb(206, 205, 205);">
                                        <option value="Botol">Botol</option>
                                        <option value="Kg">KG</option>
                                        <option value="Pcs">Pcs</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Expired Date</label>
                                    <input type="date" class="form-control" name="expired_date"
                                        style="background-color: rgb(206, 205, 205);">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="number" class="form-control" name="harga_satuan"
                                        style="background-color: rgb(206, 205, 205);" placeholder="Masukan Nominal Harga">
                                </div>
                            </div>

                            <div class="col-lg-10">
                                <div class="form-group" style="width: 100%">
                                    <button type="submit" class="btn btn-primary text-dark"
                                        style="width: 30%">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <hr>

                    {{-- Table Data User --}}
                    <div class="card-header">
                        <h4 class="card-title text-center">Data Stock Product</h4>
                    </div>
                    <div class="mt-5">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td style="width: 20px">No</td>
                                        <td>Kode Product</td>
                                        <td>Nama Product</td>
                                        <td>Expire</td>
                                        <td>Jumlah</td>
                                        <td>Satuan</td>
                                        <td>Harga</td>
                                        <td style="width: 30px">Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $barang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $barang->kode_barang }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td>{{ $barang->expired_date->format('d M Y') }}</td>
                                            <td>{{ $barang->jumlah_barang }}</td>
                                            <td>{{ $barang->satuan }}</td>
                                            <td>{{ $barang->harga_satuan }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle text-dark" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item edit" href="javascript:void(0)"
                                                            data-action="{{ route('barang.edit', $barang->id) }}"><i
                                                                class="fas fa-pencil"></i>Edit</a>
                                                        <a href="javascript:void(0)" class="delete dropdown-item"
                                                            data-delete-href="{{ route('barang.destroy', $barang->id) }}"
                                                            data-delete-message="Yakin Ingin Menghapus Data Ini"><i
                                                                class="fas fa-delete"></i>Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Data table
        $(document).ready(function() {
            $('#dataTable').DataTable()
        })

        $(function() {

            let $formData = $('#formData')
            let $submit = $formData.find('button[type="submit"]').ladda()

            const formSubmit = ($form, $submit, $url, $method) => {
                $form.off('submit')
                $form.on('submit', function(e) {
                    e.preventDefault()

                    $submit.ladda('start')
                    let data = $(this).serialize()

                    ajaxSetup()
                    $.ajax({
                        url: $url,
                        method: $method,
                        data: data,
                        dataType: 'json',
                    }).done(response => {
                        successNotification('Berhasil', 'Berhasil Di Simpan')
                        $submit.ladda('stop')

                        window.location.reload("{{ route('gudang.index') }}")
                    }).fail(error => {
                        $submit.ladda('stop')
                        ajaxErrorHandling(error, $form)
                    })
                })
            }


            /**
             * Action Delete And Edit
             **/
            $(function() {

                $.each($('.delete'), (i, deleteBtn) => {
                    $(deleteBtn).off('click')
                    $(deleteBtn).on('click', function(e) {
                        let {
                            deleteMessage,
                            deleteHref
                        } = $(this).data()

                        confirmation(deleteMessage, function() {
                            ajaxSetup()
                            $.ajax({
                                url: deleteHref,
                                type: 'DELETE',
                                dataType: 'json',
                            }).done(response => {
                                let message = "Data Berhasil Dihapus"
                                successNotification('berhasil', message);

                                window.location.reload(
                                    "{{ route('gudang.index') }}", 1000
                                    )
                            }).fail(error => {
                                ajaxErrorHandling(error);
                            })
                        })
                    })
                })
            })

            $(function() {
                $.each($('.edit'), (i, editBtn) => {
                    $(editBtn).off('click')
                    $(editBtn).on('click', function(e) {
                        let url = $(this).data('action')

                        ajaxSetup();
                        $.ajax({
                            url: url,
                            type: 'get',
                            dataType: 'json',
                        }).done(response => {
                            let barang = response.barang

                            $formData.find(`[name="kode_barang"]`).val(barang.kode_barang).change()
                            $formData.find(`[name="jumlah_barang"]`).val(barang.jumlah_barang).change()
                            $formData.find(`[name="nama_barang"]`).val(barang.nama_barang).change()
                            $formData.find(`[name="satuan"]`).val(barang.satuan).change()
                            $formData.find(`[name="harga_satuan"]`).val(barang.harga_satuan).change()
                            
                            // Url Update 
                            let urlUpdate = "{{ route('barang.update', ':id') }}".replace(':id', barang.id)
                            
                            formSubmit(
                                $formData,
                                $submit,
                                urlUpdate,
                                'PUT'
                            )
                        }).fail(error => {

                        })
                    })
                })
            })

            /**
             * Store Action
             */
            formSubmit(
                $formData,
                $submit,
                "{{ route('barang.store') }}",
                'POST'
            )

        })
    </script>
@endsection
