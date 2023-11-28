@extends('masters', ['title'=>'Setup Pembeli'])

@section('content')

<h1>checkout Pembeli</h1>
<hr>

<div class="row">
    <div class="col-md-6">
        <h3>Detail Pembeli</h3>
        <hr>
        <table class="table table-bordered">
            <tr>
                <th>Nama Pembeli</th>
                <td>{{ $userLatest->nama_pembeli }}</td>
            </tr>
            <tr>
                <th>Tanggal Pembelian</th>
                <td>{{ $userLatest->created_at }}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <h3>Detail Makanan</h3>
        <hr>
        <a href="{{ route('food.index') }}">Edit Pemesanan</a>
        <table class="table table-bordered">
            <tr>
                <th>Nama Makanan</th>
                <th>Harga Makanan</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
            @foreach($groupedFoods as $food)
            <tr>
                <td>{{ $food['dish']->nama_makanan }}</td>
                <td>Rp {{ number_format($food['dish']->harga_makanan, 0, ',', '.') }}</td>
                <td>{{ $food['total'] }} pcs</td>
                <td>Rp {{ number_format($food['harga'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <h6>total keseluruhan: Rp {{ number_format($hargaOverAll, 0, ',', '.') }}</h6>
        <h6>pajak 5% </h6>
        <h6>Grand Total : Rp {{ number_format($hargaAkhir, 0, ',', '.') }}</h6>

        <form action="{{ route('checkout.update') }}" method="post">
            @csrf
            @method('patch')

            <input type="hidden" value="{{ number_format($hargaAkhir, 0, ',', '.') }}" name="subtotal_pembelian">
            <input type="hidden" value="Success" name="status_pembelian">
            <input type="hidden" value="{{ $userLatest->nama_pembeli }}" name="nama_pembeli">

            <select class="form-select" name="payment_method" id="">
                <option value="">--Pilih Metode Pembayaran--</option>
                <option value="Cash">Cash</option>
                <option value="Ovo">OVO</option>
                <option value="Gopay">GoPay</option>
            </select>

            <button class="btn mt-2" type="submit"><i class="fas fa-shopping-cart"></i>Checkout</button>

        </form>


    </div>

</div>

@endsection