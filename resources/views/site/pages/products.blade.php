<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    @include('site.partials.styles')
</head>
<body>
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4">
                <figure class="card card-product">
                    @if ($product->images->count() > 0)
                        <div class="img-wrap padding-y"><img src="{{ asset('storage/'.$product->images->first()->full) }}" alt=""></div>
                    @else
                        <div class="img-wrap padding-y"><img src="https://via.placeholder.com/176" alt=""></div>
                    @endif
                    <figcaption class="info-wrap">
                        <h4 class="title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h4>
                    </figcaption>
                    <div class="bottom-wrap">
                        <a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-success float-right"><i class="fa fa-cart-arrow-down"></i> Buy Now</a>
                        @if ($product->sale_price != 0)
                            <div class="price-wrap h5">
                                <span class="price"> {{ config('settings.currency_symbol').$product->sale_price }} </span>
                                <del class="price-old"> {{ config('settings.currency_symbol').$product->price }}</del>
                            </div>
                        @else
                            <div class="price-wrap h5">
                                <span class="price"> {{ config('settings.currency_symbol').$product->price }} </span>
                            </div>
                        @endif
                    </div>
                </figure>
            </div>
        @empty
            <p>No Products found in.</p>
        @endforelse
    </div>
    @include('site.partials.scripts')
</body>
</html>