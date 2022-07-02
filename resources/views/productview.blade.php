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
            
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="images p-3">
                                <div class="text-center p-4"> <img id="main-image"
                                        src="{{ 'https://m.media-amazon.com/images/I/612POrS7WnL._AC_UX425_.jpg' }}"
                                        width="250" /> </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            @if(request()->get('remove-from-cart'))
                            <div class="alert alert-danger">product removed from cart</div>
                            @endif
                            @if(request()->get('added-to-cart'))
                            <div class="alert alert-success">product added to cart</div>
                            @endif
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                </div>
                                <h6 class="mt-4 mb-3"> <span
                                        class="text-uppercase text-muted brand">{{ $product->name }}</span>
                                    <div class="price d-flex flex-row align-items-center"> <span
                                            class="act-price">${{ $product->price }}</span>
                                    </div>
                                </h6>
                                <p class="about">{{ $product->description }}</p>
                                <div class="sizes mt-5">
                                    <p>Size : <span>{{ $product->size }}</span></p>
                                    <p>return policy : <span>{{ $product->return_policy }}</span></p>
                                </div>
                            </div>
                            {{-- <div class="cart mt-4 mb-4 align-items-center"> <button
                                    class="btn btn-success text-uppercase mr-2 px-4"><a
                                        href="{{ url('add-to-cart/' . $product->id) }}">Add to cart 🛒</a></button>
                                <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i>
                            </div> --}}
                            @if (!in_array($product->id, explode(',', Cookie::get('PRODUCT_COOKIE'))))
                            <div class="cart mt-4 mb-4 align-items-center"> <button
                                class="btn btn-success text-uppercase mr-2 px-4"><a
                                    href="{{ url('add-to-cart/' . $product->id) }}">Add to cart 🛒</a></button>
                            <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i>
                        </div>
                        @endif
                            
                            <div class="cart mt-4 mb-4 align-items-center"> <button
                                    class="btn btn-info text-uppercase mr-2 px-4 "><a
                                        href="{{ url('confirmOrder/' . $product->id) }}">Buy Now</a></button> <i
                                    class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i>
                            </div>
                            @if (in_array($product->id, explode(',', Cookie::get('PRODUCT_COOKIE'))))
                                <div class="cart mt-4 mb-4 align-items-center"> <button
                                        class="btn btn-danger text-uppercase mr-2 px-4"><a
                                            href="{{url('remove-from-cart/' . $product->id)}}">remove from cart 🛒</a></button>
                                    <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i>
                                </div>
                            @endif


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
