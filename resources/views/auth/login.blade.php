@extends('layouts.app-nonav')

@section('content')

<div class="view full-page-intro">
    <!-- Content -->
    <div class="container">

        <!--Grid row-->
        <div class="row wow animated fadeIn">

            <!--Grid column-->
            <div class="col-md-4"></div>
            <div class="col-md-4 my-5">
                <div class="card stylish-color-dark">
                    <div class="card-body p-4">
                        <!-- Form -->
                        <form method="POST" action="{{ url('login') }}">
                            {{ csrf_field() }}

                            <!-- Heading -->
                            <div class="text-center white-text mb-5">
                                <h4>
                                    <i class="fas fa-key"></i> Login
                                </h4>
                            </div>
                            <div class="p-2 rounded white z-depth-2">
                                <div class="md-form p-2">
                                    <input type="text" id="form3" class="form-control" name="username" value="" 
                                        autocomplete="off" required="" autofocus="">
                                    <label for="form3" class="pl-3">Username</label>
                                </div>
                                <div class="md-form p-2">
                                    <input id="form2" class="form-control" name="password" type="password" required="">
                                    <label for="form2" class="pl-3">Password</label>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <button class="btn  btn-md btn-outline-light waves-effect waves-light">
                                    <i class="fa fa-sign-in-alt" aria-hidden="true"></i> Login
                                </button>
                            </div>
                            <hr>
                            <div class="text-center">
                                <small class="text-white">
                                    DOST-CAR Portal (Beta)<br>
                                    © Department of Science & Technology - CAR<br>
                                    All Rights Reserved 2019
                                </small>
                            </div>
                        </form>
                        <!-- Form -->
                    </div>
                </div>
            </div>
            <!--Grid column-->

            <div class="col-md-4"></div>

        </div>
        <!--Grid row-->

    </div>
    <!-- Content -->

</div>

@endsection
