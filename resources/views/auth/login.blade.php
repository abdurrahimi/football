<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('public/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('public/assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" id="formLogin" method="post" action="">
                                        <div class="alert alert-success" style="display: none" role="alert"></div>
                                        <div class="alert alert-danger" style="display: none" role="alert"></div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block btn-submit">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('public/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('public/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('public/assets/js/sb-admin-2.min.js')}}"></script>
    <script>
        $('#formLogin').on('submit',function(e){
            $('.alert-danger').hide();
            $('.btn-submit').prop('disabled',true);
            $('.btn-submit').text('Please Wait...');
            var datas = $('#formLogin').serializeArray();
            var data = {};

            $.each(datas, function() {
                data[this.name] = this.value;
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method  : 'post',
                url     : "{{url('auth')}}",
                dataType: 'json',
                data    : data,
                success: function(data) {
                    if(data.result=="OK"){
                        $('.alert-success').text(data.msg);
                        $('.alert-success').show();
                        location.href = "{{url('/')}}";
                    }else{
                        $('.alert-danger').text(data.msg);
                        $('.alert-danger').show();
                        $('.btn-submit').prop('disabled',false);
                        $('.btn-submit').text('Login');
                    }
                    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                
                }
            })
            e.preventDefault();
        })
    </script>

</body>

</html>