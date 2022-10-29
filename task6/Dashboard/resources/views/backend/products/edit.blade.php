@extends('backend.layouts.parent')

@section('title', 'Edit Product')

@section('content')
    <div class="row">
        @include('backend.includes.messages');
        
        <div class="col-12">

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en" class="form-label">Name En</label>
                        <input type="text" name="name_en" class="form-control" id="name_en"
                            value="{{ $product->name_en }}">
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar" class="form-label">Name Ar</label>
                        <input type="text" name="name_ar" class="form-control" id="name_ar"
                            value="{{ $product->name_ar }}">
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="price" value="{{ $product->price }}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="code" class="form-label">Code</label>
                        <input type="number" name="code" class="form-control" id="code" value="{{ $product->code }}">
                        @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity"
                            value="{{ $product->quantity }}">
                        @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{ $product->status == 1 ? 'selected' : '' }} value="1"> Active</option>
                            <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Not Active</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="brand" class="form-label">Brand</label>
                        <select name="brand" id="brand" class="form-control">
                            @foreach ($brands as $brand)
                                <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                    value="{{ $brand->id }}">
                                    {{ $brand->name_en }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="subcat" class="form-label">Subcategories</label>
                        <select name="subcat" id="subcat" class="form-control">
                            @foreach ($subcategories as $subcategory)
                                <option {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}
                                    value="{{ $subcategory->id }}">{{ $subcategory->name_en }}</option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="desc_en" class="form-label">Desc En</label>
                        <textarea type="text" name="desc_en" class="form-control"
                            id="desc_en">{{ $product->desc_en }}</textarea>
                        @error('desc_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="desc_ar">Desc Ar</label>
                        <textarea type="text" name="desc_ar" class="form-control"
                            id="desc_ar">{{ $product->desc_ar }}</textarea>
                        @error('desc_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                        <div class="col-4">
                            <img src="{{ url('dist/img/products/' . $product->image) }}"
                                alt="{{ $product->name_en }}">
                        </div>
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning" name='update'>Update</button>
            </form>
        </div>
    </div>

@endsection
