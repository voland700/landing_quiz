@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Update Вопросы квеста для товаров')
@section('h1', 'Редактирование Вопроса: '.$question->name )

@section('content')
    <div class="col-md-6">
        @if (count($errors) > 0)
            <div class="card bg-danger">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
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
                <form role="form" method="post" action="{{ route('questions.update', $question->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="active" name="active" @if($question->active) checked @endif>
                            <label for="active" class="custom-control-label">Вопрос активен</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Наименование</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"   value="{{$question->name}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sort" class="col-sm-2 col-form-label">Сортировка</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort" name="sort" value="{{ $question->sort}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Применить</button>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <p></p>
            </div>
            <!-- /.card-footer-->
        </div>
    </div>
@endsection
