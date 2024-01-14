<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $restaurants = Restaurant::all();
      //  $orders = Order::all();

    return view('admin.restaurants.restaurants', compact('users', 'restaurants'/*, 'orders'*/));
    }


    //USERS
    public function viewUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }


    //Restaurants
    public function create()
    {
        return view('admin.restaurants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'location' => 'nullable',
            'cost' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $restaurantData = $request->except('image');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images/restaurants');
            $restaurantData['image'] = 'storage/' . str_replace('public/', '', $imagePath);
        }

        Restaurant::create($restaurantData);

        return redirect()->route('admin.restaurants.restaurants')->with('success', 'Restaurant created successfully');
    }

    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'cost' => 'nullable|string|in:$,$$,$$$,$$$$,$$$$$',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $restaurantData = $request->except('image');

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('public/images/restaurants');
            $restaurantData['image'] = Storage::url($imagePath);
        }

        $restaurant->update(array_merge($validatedData, $restaurantData));

        return redirect()->route('admin.restaurants.restaurants')->with('success', 'Restaurant updated successfully');
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect()->route('restaurants.index')->with('success', 'Restaurant deleted successfully');
    }


}