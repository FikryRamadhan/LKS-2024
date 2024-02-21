<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="_token" content="N8bSUAQ1IjUid9QN8QVI4mRxpCBSz6oyXSwNd9RQ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Login | Food XYZ</title>

    <script src="{{ url('js/plugin/webfont/webfont.min.js') }}"></script>
    <link rel="stylesheet" href="{{ url('vendors/login/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('css/atlantis.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('vendors/ladda/ladda-themeless.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/jquery-confirm/jquery-confirm.css') }}">
    <link rel="stylesheet" href="{{ url('css/custom/select2-atlantis.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/custom/login-added.css') }}" />
    <style type="text/css">
        .container:before {
            background-image: linear-gradient(-45deg, #cd0303 0%, #ac00d7 100%);
        }
        .image {
            width: 100%;
            display: block;
            object-fit: contain
        }

        .form-control-user {
            background-color: rgb(219, 221, 217);
            color: black;
        }

        h2 {
            font-weight: bold;
            font-family: 'arial', Courier, monospace
        }

        button:active {
            background-color: rgb(197, 188, 188);
        }

        .btn-rounded {
            border: 0px;
            border-radius: 30px;
        }

        .w-full {
            width: 100%;
        }

        .btn-gray {
            background-color: rgb(219, 221, 217);
        }

        @media (max-width: 768px) {
            .btn-gray {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class=" o-hidden border-0 ">
                    <div class=" p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{ asset('/img/logofood.png') }}" class="image" alt="">
                                    </div>
                                    <div class="text-center">
                                        <h2 class="bold text-gray-900 mb-4">Food XYZ</h2>
                                    </div>

                                    <form method="POST" id="formLogin" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username"
                                                placeholder="Username" required autofocus>
                                            <span class="invalid-feedback"></span>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Password" required>
                                        </div>

                                        <span class="invalid-feedback"></span>

                                        <div class="row justify-content-center m-2 d-flex align-items-center">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <button type="submit"
                                                            class="btn btn-primary w-full btn-rounded">
                                                            Submit
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <button type="reset" class="btn btn-gray w-full btn-rounded">
                                                            Reset
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ url('js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ url('js/core/popper.min.js') }}"></script>
    <script src="{{ url('js/core/bootstrap.min.js') }}"></script>


    <!-- Bootstrap Notify -->
    <script src="{{ url('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Atlantis JS -->
    <script src="{{ url('vendors/login/sb-admin-2.min.js') }}"></script>

    <script src="{{ url('vendors/ladda/spin.min.js') }}"></script>
    <script src="{{ url('vendors/ladda/ladda.min.js') }}"></script>
    <script src="{{ url('vendors/ladda/ladda.jquery.min.js') }}"></script>
    <script src="{{ url('js/myJs.js') }}"></script>

    <script type="text/javascript">
        $(function() {

            const $formLogin = $('#formLogin');
            const $formLoginSubmitBtn = $('#formLogin').find(`[type="submit"]`).ladda();


            $formLogin.on('submit', function(e) {
                e.preventDefault();
                $('.message-error').html('')

                const formData = $(this).serialize();
                $formLoginSubmitBtn.ladda('start')

                ajaxSetup()
                $.ajax({
                        url: "{{ route('login.proses') }}",
                        method: 'post',
                        data: formData,
                        dataType: 'json'
                    })
                    .done(response => {
                        let user = response.user
                        successNotification('Berhasil', 'Login Berhasil')
                        if (user.type_user == 'Admin') {
                            window.location.href = "{{ url('/') }}";
                        } else if (user.type_user == 'Gudang') {
                            window.location.href = "{{ route('gudang.index') }}";
                        } else if (user.type_user == 'Kasir') {
                            window.location.href = "{{ route('kasir.index') }}";
                        }

                    })
                    .fail(error => {
                        $formLoginSubmitBtn.ladda('stop');
                        errorNotification('Error', 'Username/Password Salah');
                    })
            })

        })
    </script>

</body>

</html>
