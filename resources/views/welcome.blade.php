@extends('layouts.app')

@section('title')
    Главная
@endsection

@section('script')
    {{ asset('/js/main.js') }}
@endsection

@section('content')
    <div class="order-wrapper hidden">
        <div class="back-black"></div>
        @guest
            <form class="order__item" method="get" action="{{ route('login') }}">
                @csrf
                <h2 class="order__h2"></h2>
                <img src="" alt="image" class="order__image">
                <p class="order__content"></p>
                <p class="order__content order__price"></p>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-right" name="product_id" value="">Заказать</button>
                </div>

            </form>
        @else
            <form class="order__item" method="post" action="{{ route('order.create') }}">
                @csrf
                <h2 class="order__h2"></h2>
                <img src="" alt="image" class="order__image">
                <p class="order__content"></p>
                <p class="order__content order__price"></p>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-right" name="product_id" value="">Заказать</button>
                </div>

            </form>
        @endguest

    </div>


    <div class="container">
        <div class="row">
            <div class="col-7">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active" data-id="1">
                            <img src="{{ asset('/img/employee.jpg') }}" class="d-block w-100 pagination__image"
                                 alt="...">
                        </div>

                        @foreach($products as $product)
                            <div class="carousel-item pagination-product" data-id="{{ $product->product_id }}">
                                <img src="{{ asset($product->src) }}" class="d-block w-100 pagination__image"
                                     alt="...">
                                <div class="hidden__content">
                                    <p>Подробнее</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                        {{--                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
                        {{--                        <span class="visually-hidden">Previous</span>--}}
                        <i class="fas fa-arrow-circle-left"></i>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                        <i class="fas fa-arrow-circle-right"></i>
                        {{--                        <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
                        {{--                        <span class="visually-hidden">Next</span>--}}
                    </a>
                </div>
            </div>
            <div class="col-5">
                <h1>Главная страница</h1>
                <p class="main_content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam culpa eaque, eius ex laudantium
                    odio
                    reprehenderit similique! Alias aliquam atque consectetur deserunt, dolorum, eius eum explicabo fuga
                    hic id iste
                    iusto laudantium, maxime molestiae nostrum numquam omnis quis saepe soluta totam. Dicta dolorem
                    expedita impedit
                    itaque nostrum numquam perspiciatis placeat.
                </p>
            </div>
        </div>
    </div>

@endsection
