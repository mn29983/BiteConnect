@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Create Menu Item</h2>
        <form method="POST" action="{{ route('menus.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="Burger">Burger</option>
                    <option value="Pizza">Pizza</option>
                    <option value="Pasta">Pasta</option>
                    <option value="Salad">Salad</option>
                    <option value="Soup">Soup</option>
                    <option value="Sandwich">Sandwich</option>
                    <option value="Wraps">Wraps</option>
                    <option value="Desert">Desert</option>
                    <option value="Fish">Fish</option>
                    <option value="BBQ">BBQ</option>

                </select>
            </div>

            <div class="form-group">
                <label for="restaurant_id">Restaurant</label>
                <select class="form-control" id="restaurant_id" name="restaurant_id">
                    @foreach ($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Menu Item</button>
        </form>
    </div>
@endsection
