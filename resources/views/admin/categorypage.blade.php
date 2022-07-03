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
                    {{-- message add category and category exist --}}
                    @if (session()->has('message1'))
                        <div class="alert alert-success" role="alert">
                            Categrogy added successfully
                        </div>
                    @endif
                    @if (session()->has('message2'))
                        <div class="alert alert-danger" role="alert">
                            Category Already Exist
                        </div>
                    @endif
                    @if (session()->has('message8'))
                        <div class="alert alert-danger" role="alert">
                            Category deleted
                        </div>
                    @endif

                    {{-- form category --}}
                    <div class="row">
                        <div class="col card-header bg-dark">
                            ADD Category
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="{{ url('addcategory') }}">
                                @csrf
                                <div class="mb-3 mt-2">
                                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="categoryname"
                                        id="exampleInputEmail1" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>

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
                            {{-- show category --}}
                            <table class="table table-dark table-striped my-2">
                                <tr>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a class="btn btn-light" href="{{ route('edit', ['id' => $item->id]) }}">
                                                <img src="{{ URL('img/edit.svg') }}" width="20px" height="20px"
                                                    class="d-inline-block mx-2" title="edit">
                                            </a>
                                            <a class="btn btn-light" href="{{ url('delete', ['id' => $item->id]) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                                                <img src="{{ URL('img/trash.svg') }}" width="20px" height="20px"
                                                    class="d-inline-block mx-2" title="delete">
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
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
