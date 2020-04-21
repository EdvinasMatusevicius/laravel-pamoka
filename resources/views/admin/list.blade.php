@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Admins
                        <a href="{{ route('admins.create') }}" class="btn btn-sm btn-primary">+</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->last_name}}</td>
                                    <td>{{ $item->email }}</td>
                                 
                                    <td class="@if($item->active)text-success @else text-danger @endif">{{$item->active ? 'yes' : 'no'}}</td>
                                    <td>
                                        <a href="{{ route('admins.edit', ['admin' => $item->id]) }}"
                                           class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admins.destroy', ['admin' => $item->id]) }}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit"
                                                   onclick="return confirm('Do you really want to delete a record?');"
                                                   class="btn btn-sm btn-danger" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>

                    <div class="card-footer">
                        {{ $list->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
