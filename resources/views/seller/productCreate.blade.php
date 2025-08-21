@extends('seller.layout.sellerDashTemp')
@section('content')
    <div class="product-form-wrapper">
        <div class="product-form-card">
            <header>
                <h2>Product Registration</h2>
            </header>
            @if(session('success'))
                <p class="alert alert-success">
                    {{ session('success') }}
                </p>
            @endif
            @if (session('error'))
                <p class="alert alert-danger">
                    {{ session('error') }}
                </p>
            @endif
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                <div class="product-form-grid">
                    <div class="product-form-section">
                        <h3>General Information</h3>
                        <div class="product-form-group">
                            <label for="product-name">Product Name</label>
                            <input type="text" name="name" class="form-control" id="name" value={{old('name')}}>
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                        </div>

                        <div class="product-form-group">
                            <label for="category">Category</label>
                            <select name="category_id" class="form-select" id="category_id" >
                                <option value="" disabled selected>Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="product-form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" class="form-control" id="slug" value={{old('slug')}}>
                                @error('slug')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                        </div>
                         <div class="product-form-group">
                            <label for="product-description">Product Description</label>
                            <textarea name="description" rows='5' class="form-control" id="description">{{old('description')}}</textarea>
                                @error('description')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                        </div>
                    </div>

                    <div class="product-form-section">
                        <h3>Pricing & Inventory</h3>
                        <div class="product-form-group">
                            <label for="price">Price per kg</label>
                            <div class="product-form-price-group">
                                <span class="product-form-currency-symbol">&#8358</span>
                                    <input type="text" name="price_per_kg" class="form-control" id="price_per_kg" value={{old('price_per_kg')}}>
                                <span class="product-form-currency-symbol">.00</span>
                                @error('price_per_kg')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="product-form-group">
                            <label for="stock">Stock Weight Available kg</label>
                            <input type="text" name="available_weight" class="form-control" id="available_weight" value={{old('available_weight')}}>
                                @error('available_weight')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                        </div>

                        <h3>Product Media</h3>
                        <div class="product-form-group">
                            <label>Product Images</label>
                            <div class="product-form-image-drop-area">
                                <p>Click here to choose File</p>
                                <input type="file" name="image" class="form-control" id="image" accept="image/*" >
                                @error('image')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                </div>
                <div class="product-form-actions">
                    <button type="submit" class="product-form-btn product-form-btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>

@endsection
