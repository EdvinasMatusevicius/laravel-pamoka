@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @isset($customer->id)
                            Edit
                        @else
                            New
                        @endisset
                        customer
                    </div>
                    <form action="{{ route('customers.'.(isset($customer->id) ? 'update' : 'store'), (isset($customer->id) ? ['customer' => $customer->id] : [])) }}" method="post">
                        @csrf
                        @isset($customer->id)
                            @method('put')
                        @endisset

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                       id="name"
                                       value="{{ old('name', $customer->name ?? '') }}">
                                @error('name')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                       name="email" id="email"
                                       value="{{ old('email', $customer->email ?? '') }}">
                                @error('email')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                       name="password" id="password" value="">
                                @error('password')
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                       name="password_confirmation"
                                       id="password-confirm" value="">
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
