@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Список заказов обратных звонков')
@section('h1', 'Список заказов обратного звонка')

@section('content')
    <div class="col-md-9">
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
                <p></p>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">N</th>
                        <th style="width: 120px">Дата</th>
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th style="width: 20px">Новый</th>
                        <th style="width: 120px">Данные</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($callbacks as $callback)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$callback->created_at}}</td>
                            <td>{{$callback->name}}</td>
                            <td>{{$callback->phone}}</td>
                            <td class="text-center">
                                @if($callback->new)
                                    <span class="new-icon"><i class="fas fa-circle fa-xs"></i></span>
                                @else
                                    <span class="old-icon"><i class="far fa-circle fa-xs"></i></span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('callbacks.show', $callback->id) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                <form method="POST" action="{{ route('callbacks.destroy', $callback->id) }}" class="formDelete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete" onclick="return confirm('Подтвердите удаление')"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <p></p>
            </div>
            <!-- /.card-footer-->
        </div>
            {{ $callbacks->links() }}
    </div>
@endsection
