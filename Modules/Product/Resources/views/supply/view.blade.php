@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        View supplier
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('Key') }}</th>
                                <th>{{ __('Value') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ __('Title') }}</td>
                                <td>{{ $item->title }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Logo') }}</td>
                                <td>
                                    @isset($item->logo)
                                        <img src="{{ Storage::url($item->logo) }}" width="200" alt="">
                                    @endisset
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Phone') }}</td>
                                <td>{{ $item->phone }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Email') }}</td>
                                <td>{{ $item->email }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Address') }}</td>
                                <td>{{ $item->address }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Created') }}</td>
                                <td> {{ $item->created_at }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Last update') }}</td>
                                <td>{{ $item->updated_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('supplier.edit', ['supplier' => $item->id]) }}"
                           class="btn btn-sm btn-primary">Edit</a>
                        <a href="{{ route('supplier.index') }}" class="btn btn-sm btn-dark">Back to list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection