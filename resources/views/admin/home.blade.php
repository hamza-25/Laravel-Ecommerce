<x-app-layout>

</x-app-layout>
{{-- @include('adminsidebar.index') --}}
<!-- The sidebar -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>admin home</title>
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
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">product
                                    trashed</span></a>
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
                    {{-- message add category and category exist --}}
                    @if (session()->has('message'))
                        <div class="alert alert-danger" role="alert">
                           User Banned
                        </div>
                    @endif
                    @if (session()->has('message2'))
                        <div class="alert alert-success" role="alert">
                           User Recovered
                        </div>
                    @endif


                    {{-- message errors back-end --}}
                    @if ($errors->any())
                        <div class="alert alert-danger my-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <table class="table table-dark table-striped my-2">
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($user as $item)
                            <tr>
                                <td>{{ $item->name }}{{ " $item->last_name" }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <button class="btn btn-danger"><a style="text-decoration: none;" href="{{url("ban/" . $item->id)}}" class="text-white">
                                        Ban
                                    </a></button>
                                    <button class="btn btn-success"><a style="text-decoration: none;" href="{{url("recovery/" . $item->id)}}" class="text-white">
                                        recovery
                                    </a></button>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">No users</div>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
