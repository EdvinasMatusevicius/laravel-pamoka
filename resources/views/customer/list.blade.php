@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Customers
                        @if(canAccess('customers.create'))
                            <a href="{{ route('customers.create') }}" class="btn btn-sm btn-primary">+</a>
                        @endif
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                 
                                    <td>
                                        @if(canAccess('customers.edit'))
                                        <a href="{{ route('customers.edit', ['customer' => $item->id]) }}"
                                           class="btn btn-sm btn-primary">Edit</a>
                                            @endif
                                            @if(canAccess('customers.show'))
                                           <a href="{{ route('customers.show', ['customer' => $item->id]) }}"
                                            class="btn btn-sm btn-success">Show</a>
                                            @endif
                                            @if(canAccess('customers.destroy'))
                                        <form action="{{ route('customers.destroy', ['customer' => $item->id]) }}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit"
                                                   onclick="return confirm('Do you really want to delete a record?');"
                                                   class="btn btn-sm btn-danger" value="Delete">
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
