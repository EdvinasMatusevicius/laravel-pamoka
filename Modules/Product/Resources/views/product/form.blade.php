@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @isset($product->id)
                            Edit
                        @else
                            New
                        @endisset
                        product
                    </div>

                    <form action="{{ route('products.' . (isset($product->id) ? 'update' : 'store'), isset($product->id) ? ['product' => $product->id] : []) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($product->id)
                            @method('put')
                        @endisset

                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                       name="title" id="title"
                                       value="{{ old('title', $product->title ?? '') }}">
                                @error('title')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug"
                                       id="slug"
                                       value="{{ old('slug', $product->slug ?? '') }}">
                                @error('slug')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                @isset($product->id)
                                    @foreach($product->images as $image)
                                        <img src="{{Storage::url($image->file)}}" width="100px"
                                             class="border border-info">
                                    @endforeach
                                    <input type="checkbox" name="delete_images" value="1"> {{ __('Delete images') }}
                                @endisset
                                <input class=" @error('image') is-invalid @enderror" type="file" name="image[]"
                                       id="image"
                                       value="" multiple>
                                @error('image')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          name="description" id="description"
                                >{{ old('description', $product->description ?? '') }}</textarea>
                                @error('description')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input class="form-control @error('price') is-invalid @enderror" type="number"
                                       name="price" id="price"
                                       value="{{ old('price', $product->price ?? 0.01) }}" min="0.01" step="0.01">
                                @error('price')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="type">Product type</label>
                                @foreach($types as $key => $enum)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="type_{{ $key }}"
                                               @if (old('type', $product->type ?? null) == $key) checked @endif
                                               name="type" value="{{ $key }}">
                                        <label class="form-check-label" for="type_{{ $key }}">
                                            {{ $enum->name() }}
                                            <em>( {{ $enum->description() }} )</em>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label for="categories">Categories</label>
                                @foreach($categories as $category)
                                    <input type="checkbox" id="categories" name="categories[]"
                                           value="{{ $category->id }}"
                                           @if(in_array($category->id, old('categories', $categoryIds ?? []))) checked @endif
                                    > {{ $category->title }}
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="suppliers">Suppliers</label>
                                @foreach($suppliers as $id => $title)
                                    <input type="checkbox" id="suppliers" name="suppliers[]"
                                           value="{{ $id }}"
                                           @if(in_array($id, old('suppliers', $supplierIds ?? []))) checked @endif
                                    > {{ $title }}
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label for="active">Active</label>
                                <input class="@error('active') is-invalid @enderror" type="checkbox" name="active"
                                       id="active"
                                       value="1" @if (old('active', $product->active ?? false)) checked @endif>
                                @error('active')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
