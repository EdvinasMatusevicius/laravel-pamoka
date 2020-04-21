@extends('layouts.app');

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    View customer
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{__('Key')}}</th>
                                <th>{{__('Value')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{__('Name')}}</td>
                                <td>{{$item->name}}</td>
                            </tr>
                            </tr>                            <tr>
                                <td>{{__('Email')}}</td>
                                <td>{{$item->email}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Created')}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr>                            <tr>
                                <td>{{__('Last update')}}</td>
                                <td>{{$item->updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                @if(canAccess('customers.edit'))
                <a href="{{route('customers.edit',['customer'=>$item->id])}}" class="btn btn-sm btn-primary">Edit</a>
                @endif
                @if(canAccess('customers.index'))
                    <a href="{{route('customers.index')}}" class="btn btn-sm btn-dark">Back to list</a>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection