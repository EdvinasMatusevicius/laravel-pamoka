@extends('layouts.app');

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Roles
                    @if(canAccess('roles.create'))
                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">+</a>
                    @endif
                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Full access</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($list as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                            <td class="{{$item->full_access ? 'text-success' : 'text-danger'}}">{{ $item->full_access ? 'yes' : 'no' }}</td>
                                <td>{{ $item->description }}</td>

                                <td>
                                    @if(canAccess('roles.edit'))
                                    <a href="{{ route('roles.edit', ['role' => $item->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @endif
                                    @if(canAccess('roles.show'))
                                    <a href="{{ route('roles.show',['role'=>$item->id])}}" class="btn btn-sm btn-success">Show</a>
                                    @endif
                                    @if(canAccess('roles.destroy'))
                                    <form action="{{ route('roles.destroy', ['role' => $item->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" onclick="return confirm('Do you really want to delete a record?');" class="btn btn-sm btn-danger" value="Delete">
                                    </form>
                                    @endif                
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