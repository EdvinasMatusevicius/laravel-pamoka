@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    @if(isset($item->id))
                        Edit
                        @else
                        New
                        @endif
                     admin</div>
                    <form action="{{ route('admins.'.(isset($item->id) ? 'update' : 'store'), isset($item->id) ? ['admin' => $item->id] : [] ) }}" method="post">
                        @csrf
                        @isset($item->id)
                            @method('put')
                        @endisset

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name',$item->name ?? '') }}">
                                @error('name')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lasy_name">Last name</label>
                                <input class="form-control @error('lasy_name') is-invalid @enderror" type="text" name="last_name" id="last_name" value="{{ old('last_name',$item->last_name ?? '') }}">
                                @error('last_name')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email',$item->email ?? '') }}">
                                @error('email')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" value="">
                                @error('password')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Password confirm</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" value="">
                                @error('password')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="active">Active</label>
                                <input class=" @error('active') is-invalid @enderror" type="checkbox" name="active" id="active" value="1" @if ( old('active',$item->active  ?? false) ) checked @else  @endif >
                                @error('active')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="roles">Roles</label>
                                @foreach($roles as $role)
                                    <input type="checkbox" name="roles[]" value="{{$role->id}}" @if(in_array($role->id,old('roles',$rolesIds ?? [])))checked @endif>{{$role->name}}
                                @endforeach
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