<x-app-layout>

</x-app-layout>
<!-- The sidebar -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>customers order</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <p href=""
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </p>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                         <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">User ban</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL('categorypage') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL('subcategorypage') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span
                                    class="ms-1 d-none d-sm-inline">sub-categories</span></a>


                        </li>
                        <li>
                            <a href="{{ URL('productpage') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">products</span></a>
                        </li>

                        <li>
                            <a href="{{ URL('customerorderpage') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">customers
                                    order</span></a>
                        </li>

                        <li>
                            <a href="{{ URL('producttrashed') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">product trashed</span></a>
                        </li>
                        {{-- <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">orders
                                    status</span>
                            </a>
                        </li> --}}
                    </ul>
                    <hr>

                </div>
            </div>
            <div class="col py-3 p-3  bg-secondary  text-white">
                <div class="container">
                    <div class="m-1">order detail</div>
                   
                    <table class="table table-dark table-striped">
                        <tr>
                            <th>product name</th>
                            <th>description</th>
                            <th>photo</th>
                            <th>address</th>
                            <th>order id</th>
                            <th>creation at</th>
                            <th>qty</th>
                            <th>total price $</th>
                        </tr>
                        @foreach ($product as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td><img src="{{ $item->image }}" width="30%" height="30%"></td>
                                
                                @foreach ($address as $item)
                                    <td>
                                        <address>
                                            <pre>Full name : {{ $item->full_name }}</pre>
                                            <pre>Address : {{ $item->address }}</pre>
                                            <pre>Country : {{ $item->country }}</pre>
                                            <pre>province : {{ $item->province }}</pre>
                                            <pre>City : {{ $item->city }}</pre>
                                            <pre>Zip code : {{ $item->zipcode }}</pre>
                                        </address>

                                    </td>
                                @endforeach
                                <td>{{ $order->order_num}}</td>
                                <td>{{ $order->created_at}}</td>
                                <td>{{ $order->qty}}</td>
                                <td>{{ $order->price}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <a href="{{ URL('customerorderpage') }}">
                        <button class="btn btn-info">Back</button>
                    </a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>
