@extends('backend.layouts.parent')

@section('title', 'Create Product')

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @include('backend.includes.messages');
        
        <div class="col-12">

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en" class="form-label">Name En</label>
                        <input type="text" name="name_en" class="form-control" id="name_en" value="{{ old('name_en') }}">
                    </div>
                    <div class="col-6">
                        <label for="name_ar" class="form-label">Name Ar</label>
                        <input type="text" name="name_ar" class="form-control" id="name_ar"  value="{{ old('name_ar') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}">
                    </div>
                    <div class="col-4">
                        <label for="code" class="form-label">Code</label>
                        <input type="number" name="code" class="form-control" id="code" value="{{ old('code') }}">
                    </div>
                    <div class="col-4">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" value="{{ old('quantity') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{ old('status')==1?'selected':'' }} value="1"> Active</option>
                            <option {{ old('status')==0?'selected':'' }} value="0">Not Active</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="brand" class="form-label">Brand</label>
                        <select name="brand" id="brand" class="form-control">
                            @foreach ($brands as $brand)
                                <option {{ old('brand_id')==$brand->id?'selected':'' }} value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="subcat" class="form-label">Subcategories</label>
                        <select name="subcat" id="subcat" class="form-control">
                            @foreach ($subcategories as $subcategory)
                                <option {{ old('subcategory_id')==$subcategory->id?'selected':'' }} value="{{ $subcategory->id }}">{{ $subcategory->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="desc_en" class="form-label">Desc En</label>
                        <textarea type="text" name="desc_en" class="form-control" id="desc_en">{{ old('desc_en') }}</textarea>
                    </div>
                    <div class="col-6">
                        <label for="desc_ar">Desc Ar</label>
                        <textarea type="text" name="desc_ar" class="form-control" id="desc_ar">{{ old('desc_ar') }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary text-center" name="page" value="index">Submit</button>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-dark text-center" name="page" value="back">Submit &
                            return</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
