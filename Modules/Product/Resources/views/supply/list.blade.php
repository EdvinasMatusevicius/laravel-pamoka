@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Suppliers
                        <a href="{{ route('supplier.create') }}" class="btn btn-sm btn-primary">+</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Logo</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>

                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @isset($item->logo)
                                            <img src="{{ Storage::url($item->logo) }}" width="100" alt="">
                                        @endisset
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <a href="{{ route('supplier.edit', ['supplier' => $item->id]) }}"
                                           class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('supplier.show', ['supplier' => $item->id]) }}"
                                           class="btn btn-sm btn-success">Show</a>
                                        <form action="{{ route('supplier.destroy', ['supplier' => $item->id]) }}"
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