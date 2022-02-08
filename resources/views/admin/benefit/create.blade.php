@extends('admin.layouts.layout')

@section('title', 'Админ-панель - страница создания нового преимущества')
@section('h1', 'Новый бонус за квест')

@section('content')
    <div class="col-12">
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
    </div>

    <form id="create" role="form" method="post" action="{{ route('benefits.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-6"><!-- Start cart -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('benefits.index') }}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Основные данные</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="active" name="active" checked="">
                                <label for="active" class="custom-control-label">Элемент активен</label>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="10" placeholder="10">
                            </div>
                            <label for="sort" class="col-sm-4 col-form-label">Сортировка</label>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-12 col-form-label">Название бонуса</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"   value="{{ old('name') }}" placeholder="Название">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="thumbnail">Изображение конка - 50x50px</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="img" id="img"
                                               class="custom-file-input">
                                        <label class="custom-file-label" for="img">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div><!--//END Основные данные -->
            </div>
        </div><!-- END ROW  -->
        <button type="submit" class="btn btn-primary mt-3">Применить</button>
    </form>

@endsection

