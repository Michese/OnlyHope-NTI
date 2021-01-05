@extends('layouts.app')

@section('title')
    Заказ
@endsection

@section('script')
    {{ asset('/js/order.js') }}
@endsection

@section('content')
    <div class="container">
        <h1>Страница заказа</h1>
        <p class="main_content">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam culpa eaque, eius ex laudantium odio
            reprehenderit similique! Alias aliquam atque consectetur deserunt, dolorum, eius eum explicabo fuga hic id iste
            iusto laudantium, maxime molestiae nostrum numquam omnis quis saepe soluta totam. Dicta dolorem expedita impedit
            itaque nostrum numquam perspiciatis placeat.
        </p>

{{--        --}}
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Статус</th>
                <th scope="col">Количество</th>
                <th scope="col">Цена</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody id="card__tbody">
            @php($count = 1)
            @forelse($products as $product)
            <tr>
                <th scope="row">{{$count++}}</th>
                <td>{{ $product->title }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td><i class="fas fa-trash-alt card__remove" data-order="{{ $product->order_id }}" data-product="{{ $product->product_id }}"></i></td>
            </tr>
            @empty
                <tr>
                    <th scope="row"></th>
                </tr>
            @endforelse

            <tr class="table-primary">
                <th scope="row"></th>
                <td>Итого:</td>
                <td></td>
                <td id="quantity">{{ $resultQuantity }}</td>
                <td id="total">{{ $resultTotal }}</td>
                <td></td>
            </tr>
            </tbody>
        </table>


    </div>
@endsection
