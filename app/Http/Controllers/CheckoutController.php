<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{

    public function index()
    {
        $pembelians = User::all();

        return view('checkout.index', compact('pembelians'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_pembeli' => 'required|min:3|max:255',
            'subtotal_pembelian' => 'required',
            'payment_method' => 'required',
            'status_pembelian' => 'required',
        ]);

        User::create($validate);
        return redirect()->route('food.index')->with('success', 'Pembeli berhasil ditambahkan, silahkan masukkan pemesanan');
    }

    public function checkout()
    {
        $userLatest = User::latest()->first();

        $foods = Checkout::with('dish')
            ->where('user_id', $userLatest->id)
            ->get();

        $groupedFoods = $foods->groupBy('dish_id')->map(function ($group) {
            $dish = $group->first()->dish;
            $total = $group->count();
            $individualResultFood = $dish->harga_makanan * $total;

            return [
                'dish' => $dish,
                'total' => $total,
                'harga' => $individualResultFood,
            ];
        });

        $hargaOverAll = $groupedFoods->sum('harga');

        $hargaPajak = $hargaOverAll * 0.05;
        $hargaAkhir = $hargaOverAll - $hargaPajak;

        return view('checkout.checkout', compact('groupedFoods', 'userLatest', 'hargaOverAll', 'hargaAkhir'));
    }

    public function success(Request $request)
    {
        $latestUser = User::latest()->first();
        DB::collection('users')->where('nama_pembeli', $latestUser->nama_pembeli)->update([
            'subtotal_pembelian' => $request->subtotal_pembelian,
            'payment_method' => $request->payment_method,
            'status_pembelian' => $request->status_pembelian,
        ]);

        return redirect()->route('checkout.index')->with('success', 'success pemesanan berhasil dilakukan');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', 'Pembeli berhasil dihapus');
    }
}
