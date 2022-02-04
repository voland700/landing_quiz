@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Список товаров ')
@section('h1', 'Список товаров')

@section('content')
    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <a href="{{route('products.create')}}" type="button" class="btn btn-primary mb-3">Создать товар</a>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th  style="width: 10px">ID</th>
                        <th>Название</th>
                        <th style="width: 20px">Active</th>
                        <th style="width: 20px">Sort</th>
                        <th style="width: 120px">Редактировать</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($products)
                        @foreach($products as $product)
                            <tr>
                                <td class="text-center">{{$product->id}}</td>
                                <td><a href="{{route("products.edit", $product->id)}}">{{$product->name}}</a></td>
                                <td>
                                    @if ($product->active === 0)
                                        <span class="pale-icon"><i class="far fa-check-circle"></i></span>
                                    @endif
                                    @if ($product->active === 1)
                                        <span class="green-icon"><i class="far fa-check-circle"></i></span>
                                    @endif
                                </td>
                                <td class="text-center">{{$product->sort}}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="formDelete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete" onclick="return confirm('Подтвердите удаление')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <p></p>
            </div>
            <!-- /.card-footer-->
        </div>
        {{ $products->links() }}
    </div>
@endsection
