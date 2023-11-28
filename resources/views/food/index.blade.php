@extends('masters', ['title'=>'List Menu'])

@section('content')

<h1>List Menu</h1>
<hr>
@if(request()->routeIs('minuman.index'))
<a href="{{ route('food.index') }}">Menu Makanan</a>
@else
<a href="{{ route('minuman.index') }}">Menu Minuman</a>
@endif
<a class="btn" href="{{ route('checkout.checkout') }}"><i class="fas fa-shopping-cart"></i>Checkout</a>
<div class="row">
    @foreach($foods as $food)
    <div class="col-md-3 mt-3">
        <div class="text-center">
            <img class="w-75" src="/img/{{ $food->gambar_makanan }}" alt="{{ $food->gambar_makanan }}">
            <h6>{{ $food->nama_makanan }}</h6>
            <p>{{ $food->harga_makanan }}</p>
            <!-- Tombol "+" dan "-" -->
            <form action="{{ route('food.store') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $food->id }}">
                <button type="submit" class="btn btn-sm"><i class="fas fa-plus"></i></button>
            </form>
            <span class="btn btn-light">{{ $totalFood[$food->id] }}</span>

            <form action="{{ route('food.destroy') }}" method="post">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $food->id }}">
                <button type="submit" class="btn btn-sm"><i class="fas fa-minus"></i></button>
            </form>
        </div>

    </div>
    @endforeach
</div>

@endsection