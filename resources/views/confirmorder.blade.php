<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>product view</title>
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

            <table class="table">
                <tr>
                    <th>name</th>
                    <th>photo</th>
                    <th>price $</th>
                    <th>size</th>
                    <th>Qty</th>
                    <th>action</th>
                </tr>
                <tr>
                    <th>{{ $product->name }}</th>
                    <th><img src="{{ $product->image }}" width="25%" height="25%"></th>
                    <th>{{ $product->price }}</th>
                    <th>{{ $product->size }}</th>
                    <form method="POST" action="{{ url('checkout') }}">
                        @csrf
                        <th><input type="number" name="qty" value='1' min="1"></th>
                        <th><button type="submit" class="btn btn-primary bg-primary"
                                onclick="return confirm('Are you sure you want to place order');">confirm order</button></th>
                </tr>
                <tr>
                    <th colspan="5">
                        {{-- <input class="form-control m-1" type="text" name='fullName' placeholder="full Name" required>
                        <input class="form-control m-1" type="text" name='country' placeholder="Country" required>
                        <input class="form-control m-1" type="text" name='province' placeholder="province" required>
                        <input class="form-control m-1" type="text" name='city' placeholder="city" required>
                        <input class="form-control m-1" type="text" name='phone' placeholder="phone" required>
                        <input class="form-control m-1" type="text" name='address' placeholder="address" required>
                        <input class="form-control m-1" type="text" name='zipcode' placeholder="zipcode" required>
                        <input class="form-control m-1" type="hidden" name='product_id' value="{{ $product->id }}" > --}}
                        <input class="form-control m-1" type="hidden" name='product_id' value="{{ $product->id }}" >
                        @forelse ($address as $item)
                            <div class="d-inline-block card w-25 m-2 p-2">
                                <address>
                                    <p>Full name : {{ $item->full_name }}</p><br>
                                    <p>Address : {{ $item->address }}</p><br>
                                    <p>Country : {{ $item->country }}</p><br>
                                    <p>State : {{ $item->province }}</p><br>
                                    <p>City : {{ $item->city }}</p><br>
                                    <p>zipcode : {{ $item->zipcode }}</p><br>
                                    <p>Tele : {{ $item->phone }}</p><br>
                                </address>
                                <input type="radio" name="put" value="{{ $item->id }}" required>
                                {{-- <input type="hidden" name="put" value="{{ $item->id }}" required > --}}
                            </div>
                        @empty
                            <div>
                                <p>add new address to place order</p>
                            </div>
                        @endforelse


                       <br> <input type="checkbox" checked name="CashOnDelivery" value="cash on Delivery">Cash on Delivery


                    </th>
                </tr>
                {{-- <input type="checkbox"  name="json[]" value="1">1<br>
                <input type="checkbox"  name="json[]" value="2">2<br>
                <input type="checkbox"  name="json[]" value="3">3<br> --}}

                </form>
            </table>
            <a href="{{ url('addAddress') }}">
                <button class="btn btn-info">add address </button>
            </a>

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
