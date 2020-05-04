@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @isset($item->id)
                            Edit
                        @else
                            New
                        @endisset
                        supplier
                    </div>

                    <form action="{{ route('supplier.' . (isset($item->id) ? 'update' : 'store'), isset($item->id) ? ['supplier' => $item->id] : []) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($item->id)
                            @method('put')
                        @endisset

                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                       name="title" id="title"
                                       value="{{ old('title', $item->title ?? '') }}">
                                @error('title')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="logo">Logo</label>
                                @isset($item->logo)
                                    <img src="{{Storage::url($item->logo)}}" width="100px" class="border border-info" alt="">
                                    <input type="checkbox" name="delete_logo" value="1"> {{ __('Delete logo') }}
                                @endisset
                                <input class=" @error('logo') is-invalid @enderror" type="file" name="logo"
                                       id="logo" value="">
                                @error('logo')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone"
                                       id="phone"
                                       value="{{ old('phone', $item->phone ?? '') }}">
                                @error('phone')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                                       id="email"
                                       value="{{ old('email', $item->email ?? '') }}">
                                @error('email')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address"
                                       id="address"
                                       value="{{ old('address', $item->address ?? '') }}">
                                @error('address')
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
