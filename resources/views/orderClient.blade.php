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
            @if (session()->has('message2'))
            <div class="alert alert-success">
                {{ session('message2') }}
            </div>
        @endif
        <div >
            <a href="{{url('clientOrderHasProduct')}}"><button class="btn btn-success m-2">
                Show Order has more products
            </button></a>
        </div>
            

            <table class="table">
                <tr>
                    <th>order number</th>
                    <th>status</th>
                    <th>total price $</th>
                    <th>created at</th>
                    <th>Action</th>
                </tr>
                @foreach ($orders as $item)
                    <tr>
                        <th>{{ $item->id }}</th>
                        <th>{{ $item->status }}</th>
                        <th>{{ $item->price }}</th>
                        <th>{{ $item->created_at }}</th>
                        <th>
                            <form method="post" action="{{ url('showDetailOrder') }}">
                                @csrf
                                <input type="hidden" value="{{ $item->product_id }}" name="product">
                                <input type="hidden" value="{{ $item->id }}" name="order">
                                <button type="submit" class="btn btn-info">Details</button>
                            </form>
                        </th>
                    </tr>
                    
                @endforeach
                {{-- @foreach($one_order as $item)
                <tr>
                    <td>{{$item->serial}}</td>
                    <td>{{$item->status}}</td>
                    <td>{{$item->total_price}}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <form method="post" action="{{ url('showDetailOneOrder') }}">
                        @csrf
                        <input type="hidden" value="{{ $item->serial}}" name="order">
                        <button type="submit" class="btn btn-info"> Details</button>
                    </form>
                </td>

                </tr>
                @endforeach --}}
            </table>
        </div>
    </div>


    <div class="d-flex justify-content-center m-4">
        {{ $orders->onEachSide(1)->links() }}
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
