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
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">product
                                    trashed</span></a>
                        </li>

                    </ul>
                    <hr>
                </div>
            </div>
            <div class="col py-3 p-3  bg-secondary  text-white">
                <div class="container">
                    <div class="m-1">customer order :</div>

                    @if (session()->has('message16'))
                        <div class="alert alert-success" role="alert">
                            status changed successfully
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger my-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <table class="table table-dark table-striped">
                        <tr>
                            <th>user name</th>
                           
                            <th>order number</th>
                            <th>date creation</th>
                            
                            <th>price $</th>
                            <th>status</th>
                            <th>details</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                               
                                <td>{{ $item->serial}}</td>
                                <th>{{ $item->created_at }}</th>
                                
                                <th>{{ $item->total_price }}</th>
                                <td>{{ $item->status }}</td>
                                <td><a
                                        href="{{ url('showOrderHasProduct/' . $item->serial) }}">
                                        <button class="btn btn-info">Show Details</button>
                                    </a>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="submit"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Change Status
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a href="{{ url('changestatusOneOrder/' . "$item->id/" . 'Order_processing') }}"
                                                    class="dropdown-item">Order processing</a>
                                            </li>
                                            <li><a href="{{ url('changestatusOneOrder/' . "$item->id/" . 'On_the_way') }}"
                                                    class="dropdown-item">On the way</a>
                                            </li>
                                            <li><a href="{{ url('changestatusOneOrder/' . "$item->id/" . 'Delivered') }}"
                                                    class="dropdown-item">Delivered</a>
                                            </li>
                                            <li><a href="{{ url('changestatusOneOrder/' . "$item->id/" . 'confirm_Delivered') }}"
                                                    class="dropdown-item">confirm Delivered</a>
                                            </li>
                                            <li><a href="{{ url('changestatusOneOrder/' . "$item->id/" . 'canceled') }}"
                                                    class="dropdown-item"
                                                    onclick="return confirm('Are you sure you want to cancel this order?');">canceled</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <a href="{{route('customerorderpage')}}"><button class="btn btn-success">Back</button></a>

                    <div class="d-flex justify-content-center m-4">
                        {{ $orders->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>
