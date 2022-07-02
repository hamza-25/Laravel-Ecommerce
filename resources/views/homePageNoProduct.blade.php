<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>shop</title>
    <style>
        .card-text {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
        }
       .card-img, .card-img-bottom, .card-img-top {
    width: auto;
    height: 250px;
}
    </style>
</head>

<body>

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

    <form action="{{ url('search') }}" method="GET">
        <div class="container input-group flex-nowrap d-flex justify-content-center w-75 p-3">
            <span class="input-group-text bg-white">
                <select class="d-inline-block mb-2 border border-white" name="categorySearch" id="categorySearch">
                    <option value="all" selected>Categories</option>
                    <ul type="circle">
                        @foreach ($categories as $item)
                            <li>
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            </li><br>

                            @foreach ($item->subCategory as $scitem)
                                <li>
                                    <option value="{{ $scitem->id }}"> {{ '->' . $scitem->name }}</option>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </select>
            </span>
            <input type="text" class="form-control" name="searchBar" placeholder="Type Search..." required>
            <span class="input-group-text bg-white">
                <button class="btn btn-outline-primary border border-white" type="submit"
                    name="submit">Search</button>
            </span>
        </div>
    </form>
    {{-- filter --}}

    <form action="{{url("filter")}}" method="POST">
        @csrf
        <div class="container w-75 p-3">
            <p>
                <a class="" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button"
                    aria-expanded="false" aria-controls="multiCollapseExample1">Advanced Serach</a>
            </p>
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="card card-body w-25 p-3 d-inline-block">
                            <div class="form-check">
                                <p>Size :</p>
                                <input class="form-check-input" type="radio" name="size" id="sizesmall"
                                    value="small">
                                <label class="form-check-label" for="sizesmall">
                                    Small
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="size" id="sizemedium"
                                    value="medium">
                                <label class="form-check-label" for="sizemedium">
                                    Medium
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="size" id="sizelarge"
                                    value="medium">
                                <label class="form-check-label" for="sizelarge">
                                    Large
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="size" id="sizeXlarge"
                                    value="medium">
                                <label class="form-check-label" for="sizeXlarge">
                                    XLarge
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="size" id="sizeXXlarge"
                                    value="medium">
                                <label class="form-check-label" for="sizeXXlarge">
                                    XXLarge
                                </label>
                            </div>

                            <div class="form-check">
                                <p>price :</p>
                                <input class="form-control m-1" type="number" name="lowPrice" min="1"
                                    placeholder="min price $">
                                <input class="form-control m-1" type="number" name="highPrice" min="1"
                                    placeholder="high price $">
                                </label>
                            </div>
                            <button class="btn btn-info">Filter</button>
                        </div>
                    </div>
                </div>
              

            </div>
    </form>

    <div class=" container alert alert-danger w-25">
        {{ $message }}
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
