<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Shopping cart</title>
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
            <p>Shopping cart</p>
            <div class="col-md-10">
                @if (count($product) > 0)
                    <table class="table table-hover">
                        <tr>
                            <th>Action</th>
                            <th>product name</th>
                            <th>photo</th>
                            <th>size</th>
                            <th>price</th>
                            <th>Quantity</th>

                        </tr>
                @endif
                @php
                    $total = 0;
                @endphp
                @forelse ($product as $item)
                    <tr>
                        <td> <a href="{{ url('cartDelete/' . $item->id) }}">
                                <button class="btn btn-danger mb-1">delete</button>
                            </a></td>
                        <form action="{{ url('shopFromCart/' . $item->id) }}" method="GET">
                            <td>
                                {{ $item->name }}
                            </td>
                            <td><img src="{{ $item->image }}" width="15%" height="15%"></td>
                            <td>{{ $item->size }}</td>
                            <td>{{ $item->price }}</td>
                            <td> <input type="number" min="1" required value="1" name="quantity"></td>
                            <td>
                                <button type="submit" class="btn btn-success mb-1 bg-success">place order</button>
                            </td>
                        </form>
                        @php
                            $total += $item->price;
                        @endphp
                    </tr>
                @empty
                    <p class="alert alert-danger">No product in cart</p>
                    <a href="{{ url('itemHome') }}"><button class="btn btn-info">home</button></a>
                @endforelse
                <td>
                    <div class="card-footer">
                        cart total price is : {{ $total }} $
                    </div>
                </td>


                {{-- @forelse ($product as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td><img src="{{ $item->image }}" width="15%" height="15%"></td>
                        <td>{{ $item->size }}</td>
                        <td>{{ $item->price }}</td>
                        <form action="{{ url('shopFromCart/' . $item->id) }}" method="GET">

                            <td> <input type="number" min="1" required value="1" name="quantity"></td>
                            <td>
                                <button type="submit" class="btn btn-success mb-1 bg-success">place order</button>
                        </form>
                        <a href="{{ url('cartDelete/' . $item->id) }}">
                            <button class="btn btn-danger mb-1">delete</button>
                        </a>
                        </td>


                    </tr>

                @empty
                    <p class="alert alert-danger">No product in cart</p>
                    <a href="{{ url('itemHome') }}"><button class="btn btn-info">home</button></a>
                @endforelse --}}
                </table>


            </div>
        </div>
    </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
