@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Menu Item</h2>
        <form method="POST" action="{{ route('menus.update', $menu->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $menu->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $menu->price }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Menu Item</button>
        </form>
    </div>
@endsection