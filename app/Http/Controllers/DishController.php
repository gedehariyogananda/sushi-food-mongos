<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Dish;
use App\Models\User;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        $foods = Dish::where('harga_makanan', '>=', 11000)->get();
        $usersLatest = User::latest()->first();

        $totalFood = [];

        foreach ($foods as $food) {
            $count = Checkout::where('user_id', $usersLatest->id)
                ->where('dish_id', $food->id)
                ->count();

            $totalFood[$food->id] = $count;
        }

        return view('food.index', compact('foods', 'totalFood'));
    }

    public function indexMinuman()
    {
        $foods = Dish::where('harga_makanan', '<', 11000)->get();
        $usersLatest = User::latest()->first();

        $totalFood = [];

        foreach ($foods as $food) {
            $count = Checkout::where('user_id', $usersLatest->id)
                ->where('dish_id', $food->id)
                ->count();

            $totalFood[$food->id] = $count;
        }

        return view('food.index', compact('foods', 'totalFood'));
    }


    public function store(Request $request)
    {
        $usersLatest = User::latest()->first();

        Checkout::create([
            'user_id' => $usersLatest->id,
            'dish_id' => $request->id,
        ]);

        return back();
    }

    public function destroy(Request $request)
    {
        $usersLatest = User::latest()->first();

        $oldestEntry = Checkout::where('user_id', $usersLatest->id)
            ->where('dish_id', $request->id)
            ->orderBy('created_at', 'asc')
            ->first();

        if ($oldestEntry) {
            $oldestEntry->delete();
        }

        return back();
    }
}
