@extends('layouts.template')

@section('content')
    <div class="align-items-center justify-content-center mt-5 ml--5 mr-5">
        <div class="float-right col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Kelola User</h4>
                </div>
                <div class="card-body">
                    <form data-action="{{ route('user.store') }}" data-update-action="{{ route('user.update', ':id') }}" id="formData">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Type User</label>
                                    <select name="type_user" id="type_user" class="form-control"
                                        style="background-color: rgb(206, 205, 205);">
                                        <option value="Admin">Admin</option>
                                        <option value="Gudang">Staff Gudang</option>
                                        <option value="Kasir">Staff Kasir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="alamat" class="form-control" name="alamat"
                                        style="background-color: rgb(206, 205, 205);" placeholder="Alamat User">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control" name="name"
                                        style="background-color: rgb(206, 205, 205);" placeholder="Nama Lengkap User">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        style="background-color: rgb(206, 205, 205);" placeholder="Username User">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Telepon</label>
                                    <input type="number" class="form-control" name="telepon"
                                        style="background-color: rgb(206, 205, 205);" placeholder="No.Hp">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password"
                                        style="background-color: rgb(206, 205, 205);" placeholder="*******">
                                </div>
                            </div>

                            <div class="col-lg-10">
                                <div class="form-group" style="width: 100%">
                                    <button type="submit" class="btn btn-primary text-dark"
                                        style="width: 30%">Tambah</button>
                                    {{-- <button class="btn btn-primary text-dark ml-2" style="width: 30%">Edit</button>
                                    <button class="btn btn-primary text-dark ml-2" style="width: 30%">Hapus</button> --}}
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Table Data User --}}
                    <div class="mt-4">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td style="width: 20px">No</td>
                                        <td>Nama</td>
                                        <td>Username</td>
                                        <td>Telepon</td>
                                        <td>Alamat</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->telepon }}</td>
                                            <td>{{ $user->alamat }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item edit" href="javascript:void(0)" data-action="{{ route('user.edit', $user->id) }}"><i class="fas fa-pencil"></i>Edit</a>
                                                        <a href="javascript:void(0)" class="delete dropdown-item" data-delete-href="{{ route('user.delete', $user->id ) }}" data-delete-message="Yakin Ingin Menghapus Data Ini" ><i class="fas fa-delete"></i>Delete</a>
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
    <script type="text/javascript">
        /**
         *  
         * Data Tables
         * 
         **/
        $(function() {
            $('#dataTable').dataTable()
        })

        /**
         * 
         * Delete Action && Edit Action
         * 
         **/
        $.each($('.delete'), (i, deleteBtn) => {
            $(deleteBtn).off('click')
            $(deleteBtn).on('click', function(e) {
                let {
                    deleteMessage,
                    deleteHref
                } = $(this).data();
                confirmation(deleteMessage, function() {
                    ajaxSetup();
                    $.ajax({
                        url: deleteHref,
                        method: 'delete',
                        dataType: 'json'
                    }).done(response => {
                        let {
                            message
                        } = "Berhasil Di Hapus";
                        successNotification('Berhasil', message);
                        window.location.reload("{{ route('user') }}")
                    }).fail(error => {
                        ajaxErrorHandling(error);
                    })
                })
            })
        })

        $.each($('.edit'), (i, editBtn) => {
            $(editBtn).off('click')
            $(editBtn).on('click', function(e){
                let url = $(this).data('action');

                ajaxSetup();
                $.ajax({
                    url:url,
                    type: 'get',
                    dataType: 'json',
                }).done(response => {
                    let user = response.user
                    $('#formData').find(`[name="name"]`).val(user.name).change();
                    $('#formData').find(`[name="username"]`).val(user.username).change();
                    $('#formData').find(`[name="telepon"]`).val(user.telepon).change();
                    $('#formData').find(`[name="alamat"]`).val(user.alamat).change();
                    $('#formData').find(`[type="submit"]`).text('Update');

                    let $formData = $('#formData')
                    let $buttonSubmit = $formData.find(`[type="submit"]`).ladda();
                    let urlUpdate = "{{ route('user.update', ':id') }}".replace(':id', user.id);
                    
                    formSubmit(
                        $formData,
                        urlUpdate,
                        $buttonSubmit,
                        'PUT'
                    )

                }).fail(error => {
                    console.log('ggl Ambil Data');
                });
            })
        })

        /**
         * 
         * Submit Button Action
         * 
        */

        const formSubmit = ($form, $url, $submit, $method) => {
            $form.off('submit')
            $form.on('submit', function(e) {
                e.preventDefault();

                // Data
                let data = $(this).serialize();
                $submit.ladda('start');
                
                // Ajax 
                ajaxSetup();
                $.ajax({
                    url: $url,
                    method: $method,
                    data: data,
                    dataType: 'json'
                }).done(response => {
                    $submit.ladda('stop');
                    successNotification('Berhasil', 'Data Berhasil Di Simpan');
                    window.location.reload("{{ route('user') }}");
                }).fail(error => {
                    $submit.ladda('stop');
                    ajaxErrorHandling(error, $form);
                })
            })
        }

        /**
         *  
         *  Add Data Action
         *  
         **/
        formSubmit(
            $('#formData'),
            "{{ route('user.store') }}",
            $('#formData').find(`[type="submit"]`).ladda(),
            'POST'
        )
    </script>
@endsection
