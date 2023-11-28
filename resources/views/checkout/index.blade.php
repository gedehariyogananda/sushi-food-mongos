@extends('masters', ['title'=>'Setup Pembeli'])

@section('content')

<h1>Setup Pembeli</h1>
<hr>

<form action="{{ route('checkout.store') }}" method="post">
    @csrf
    <label class="" for="">Nama Pembeli baru </label>
    <input type="text" class="form-control w-50 mt-3" name="nama_pembeli">
    <input type="hidden" name="subtotal_pembelian" value="0">
    <input type="hidden" name="status_pembelian" value="belum dibayar">
    <input type="hidden" name="payment_method" value="belum dibayar">
    <button type="submit" class="btn btn-sm btn-primary mt-3">submit pembeli </button>
</form>

<h6 class="mt-3">riwayat pembelian : </h6>
<table class="table table-bordered">
    <tr>
        <th>Nama Pembeli</th>
        <th>Tanggal Pembelian</th>
        <th>Total Pembelian</th>
        <th>Status Pembelian</th>
        <th>Metode Pembayaran</th>
        <th>Action</th>
    </tr>
    @foreach($pembelians as $pembelian)
    <tr>
        <td>{{ $pembelian->nama_pembeli }}</td>
        <td>{{ $pembelian->created_at->diffForHumans() }}</td>
        <td>{{ $pembelian->subtotal_pembelian }}</td>
        <td>{{ $pembelian->status_pembelian }}</td>
        <td>{{ $pembelian->payment_method }}</td>
        <td>
            <form action="{{ route('checkout.destroy', $pembelian->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger">delete</button>
            </form>
        </td>
    </tr>
    @endforeach

    @endsection