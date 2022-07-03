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
    <title>admin edit</title>
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
                       
                    </ul>
                    <hr>

                </div>
            </div>
            <div class="col py-3 p-3  bg-secondary  text-white">
                <div class="container">
                    {{-- message add category and category exist --}}
                    @if (session()->has('message5'))
                        <div class="alert alert-success" role="alert">
                            Product added Successfully
                        </div>
                    @endif
                    @if (session()->has('message7'))
                        <div class="alert alert-danger" role="alert">
                            Product deleted
                        </div>
                    @endif
                    @if (session()->has('message15'))
                    <div class="alert alert-danger" role="alert">
                        category and subcategory not compatible between them
                    </div>
                @endif
                    



                    {{-- add product --}}

                    <p>
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1"
                            role="button" aria-expanded="false" aria-controls="multiCollapseExample1">ADD PRODUCT</a>
                    </p>
                    <div class="row ">
                        <div class="col">
                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                <div class="card card-body bg-dark my-2 w-75">
                                    <form action="{{ URL('addproduct') }}" method="POST" style="color:black">
                                        @csrf
                                        <input class="form-control my-2 w-75" type="text" name="name"
                                            placeholder="Product name" required>
                                        <input class="form-control my-2 w-75" type="text" name="description"
                                            placeholder="description" required>
                                        <input class="form-control my-2 w-75" type="text" name="price"
                                            placeholder="price" required>
                                        <select class="form-select my-2 w-75" name="size" required>
                                            <option value="small">small</option>
                                            <option value="medium">medium</option>
                                            <option value="large">large</option>
                                            <option value="xlarge">xlarge</option>
                                            <option value="xxlarge">xxlarge</option>
                                        </select>
                                        <input class="form-control my-2 w-75" type="text" name="qty"
                                            placeholder="Qantity" required>
                                        <input class="form-control my-2 w-75" type="text" name="returnpolicy"
                                            placeholder="return policy" required>
                                        <input class="form-control my-2 w-75" type="url" name="photo"
                                            placeholder="photo URL" required>
                                        <p style="color: white">Category</p>
                                        <select class="form-select my-2 w-75" name="category" required>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p style="color: white">sub-Catgory</p>
                                        <select name="subcategory">
                                            @foreach ($categories as $item)
                                                <option>{{ $item->name }}</option><br>
                                                @foreach ($item->subCategory as $scitem)
                                                    <option value="{{ $scitem->id }}">{{ '--' . $scitem->name }}
                                                    </option><br>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        <p class="my-2"><button type="submit" class="btn btn-info">valide</button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
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

                        {{-- show  product --}}
                        <div class="row">
                            <div class="col card-header bg-dark">
                                Product
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">

                                {{-- show product --}}

                                <table class="table table-dark table-striped my-2">
                                    <tr>
                                        <th>product name</th>
                                        <th>description</th>
                                        <th>price</th>
                                        <th>size</th>

                                       
                                        <th>photo</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->size }}</td>

                                         

                                            <td><img src="{{ $item->image }}" width="20px" height="20px"></td>
                                            <td>{{ $item->qty }}</td>
                                            <td>
                                                <a class="btn btn-light my-1"
                                                    href="{{ url('editproduct/' . $item->id) }}">
                                                    <img src="{{ URL('img/edit.svg') }}" width="20px"
                                                        height="20px" class="d-inline-block mx-2 " title="edit">
                                                </a>
                                                <a class="btn btn-light my-1"
                                                    href="{{ url('deleteproduct/' . $item->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <img src="{{ URL('img/trash.svg') }}" width="20px"
                                                        height="20px" class="d-inline-block mx-2 " title="delete">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="d-flex justify-content-center m-4">
                                    {{ $products->onEachSide(1)->links() }}
                                </div>
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
