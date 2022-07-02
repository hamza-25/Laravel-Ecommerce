<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Orders</title>
</head>

<body style="background-color: #F9F2ED">

    @if (Auth::user())
        <x-app-layout>
        </x-app-layout>
    @else
        <nav class="navbar navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="">
                    <img src="{{ URL('img/shop2.svg') }}" alt="store_logo" width="60" height="48">
                </a>
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-primary"><a
                            href="{{ route('login') }}">Login</a></button>
                    <button type="button" class="btn btn-outline-primary"><a
                            href="{{ route('register') }}">Register</a></button>
                </div>
            </div>
        </nav>
    @endif
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            @if ($errors->any())
                <div class="alert alert-danger my-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <h2>Shipping Address : </h2>
            <fieldset class="w-25">
                <form class="row g-3 " action="{{ url('addNewAddress') }}" method="POST">
                    @csrf
                    <address>
                        <div class="col-auto m-2 shadow bg-body rounded ">
                            <input type="text" class="form-control border-0" name="full_name" placeholder="Full name"
                                required>
                        </div>
                        <div class="col-auto  m-2 shadow bg-body rounded">
                            <input type="text" class="form-control border-0" name="address" placeholder="Address"
                                required>
                        </div>
                        <div class="col-auto  m-2 shadow bg-body rounded">
                            <input type="text" class="form-control border-0" name="country" placeholder="country"
                                required>
                        </div>
                        <div class="col-auto  m-2 shadow bg-body rounded">
                            <input type="text" class="form-control border-0" name="province" placeholder="province"
                                required>
                        </div>
                        <div class="col-auto  m-2 shadow bg-body rounded">
                            <input type="text" class="form-control border-0" name="city" placeholder="city"
                                required>
                        </div>
                        <div class="col-auto  m-2 shadow bg-body rounded">
                            <input type="tele" class="form-control border-0" name="phone" placeholder="phone"
                                required>
                        </div>
                        <div class="col-auto  m-2 shadow bg-body rounded">
                            <input type="text" class="form-control border-0" name="zipcode" placeholder="zipcode"
                                required>
                        </div>
                        <div class="col-auto  m-2 ">
                            <button type="submit" class="btn btn-primary bg-primary">add address</button>
                        </div>
                    </address>
            </fieldset>
            </form>



        </div>
    </div>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
