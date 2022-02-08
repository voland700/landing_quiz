@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Вопросы квеста')
@section('h1', 'Квест - пошаговые вопросы')

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
                <a href="{{route('steps.create')}}" type="button" class="btn btn-primary mb-3">Создать шаг</a>

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
                    @if($steps)
                        @foreach($steps as $step)
                            <tr>
                                <td class="text-center">{{$step->id}}</td>
                                <td><a href="{{route("steps.edit", $step->id)}}">{{$step->name}}</a></td>
                                <td class="text-center">
                                    @if ($step->active === 0)
                                        <span class="pale-icon"><i class="far fa-check-circle"></i></span>
                                    @endif
                                    @if ($step->active === 1)
                                        <span class="green-icon"><i class="far fa-check-circle"></i></span>
                                    @endif
                                </td>
                                <td class="text-center">{{$step->sort}}</td>
                                <td>
                                    <a href="{{ route('steps.edit', $step->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <form method="POST" action="{{ route('steps.destroy', $step->id) }}" class="formDelete">
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
        {{ $steps->links() }}
    </div>
@endsection
