{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    hi
    @foreach ($oneCategory as $item)
        {{$item->name}}
    @endforeach
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>shop</title>
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


    {{-- <nav class="navbar navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="{{ URL('img/shop2.svg') }}" alt="store_logo" width="60" height="48">
            </a>
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-primary"><a href="{{ route('login') }}">Login</a></button>
                <button type="button" class="btn btn-outline-primary"><a
                        href="{{ route('register') }}">Register</a></button>
            </div>
        </div>
    </nav> --}}

    {{-- <nav class="navbar navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="{{ URL('img/shop2.svg') }}" alt="store_logo" width="60" height="48">
            </a>
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-primary"><a href="{{ route('login') }}">Login</a></button>
                <button type="button" class="btn btn-outline-primary"><a
                        href="{{ route('register') }}">Register</a></button>
            </div>
        </div>
    </nav> --}}



    <form action="{{url('search')}}" method="GET">
        <div class="container input-group flex-nowrap d-flex justify-content-center w-75 p-3">
            <span class="input-group-text bg-white">
                <select class="d-inline-block mb-2 border border-white" name="categorySearch" id="categorySearch">
                    <option value="all" selected>Categories</option>
                    <ul type="circle">
                        {{-- @foreach ($categories as $item)
                            <li>
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            </li><br>

                            @foreach ($item->subCategory as $scitem)
                                <li>
                                    <option value="{{ $scitem->id }}"> {{ '->' . $scitem->name }}</option>
                                </li>
                            @endforeach
                        @endforeach --}}
                    </ul>
                </select>
            </span>
            <input type="text" class="form-control" name="searchBar" placeholder="Type Search..." required>
            <span class="input-group-text bg-white">
                <button class="btn btn-outline-primary border border-white" type="submit"
                    name="submit">Search</button>
            </span>
        </div>
        {{-- advanced search --}}
        {{-- <div class="container w-75 p-3">
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
                                <input class="form-check-input" type="radio" name="size" id="sizesmall" value="small">
                                <label class="form-check-label" for="sizesmall">
                                    Small
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="size" id="sizemedium" value="medium">
                                <label class="form-check-label" for="sizemedium">
                                    Medium
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="size" id="sizelarge" value="medium">
                                <label class="form-check-label" for="sizelarge">
                                    Large
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="size" id="sizeXlarge" value="medium">
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
                        </div>
                    </div>
                </div>
            </div> --}}
    </form>
    </div>
    {{-- normal card --}}
    @isset($oneCategory)
        <div class="m-auto container">
            @foreach ($oneCategory as $item)
                <div
                    class="container row row-cols-1 row-cols-md-3  w-25 d-inline-block mb-2 shadow p-3 mb-2 bg-body rounded mx-5">
                    <div class="col w-100 m-auto">
                        <div class="card">
                            <img src="{{ $item->image }}" class="card-img-top" alt="product image" width=""
                                height="">
                            <div class="card-body">
                                <h5 class="card-title"><a
                                        href="{{ url('productview/' . $item->id) }}">{{ $item->name }}</a></h5>
                                <div class="card-text">{{ $item->description }}</div>
                                <a href="{{ url('confirmOrder/' . $item->id) }}"><button type="button"
                                        class="btn btn-outline-secondary">Buy Now</button></a>
                                <button type="button" class="btn btn-outline-secondary">🛒</button>
                                <p class="d-inline-block">${{ $item->price }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endisset
    
    {{-- <div class="d-flex justify-content-center m-4">
        {{ $searchproducts->links() }}
        
    </div> --}}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
