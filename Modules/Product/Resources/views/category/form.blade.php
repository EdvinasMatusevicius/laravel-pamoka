@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if(isset($category->id))
                            Edit
                        @else
                            New
                        @endif
                        category
                    </div>
                    <form action="{{ route('categories.'.(isset($category->id) ? 'update' : 'store'), isset($category->id) ? ['category' => $category->id] : []) }}" method="post">

                        @csrf
                        @isset($category->id)
                            @method('put')
                        @endisset

                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $category->title ?? '') }}">
                                @error('title')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{ old('slug', $category->slug ?? '') }}">
                                @error('slug')
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