@extends('admin.layouts.layout')

@section('title', 'Админ-панель - страница создания нового шага квеста')
@section('h1', 'Новый шаг квеста')

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

    <form id="create" role="form" method="post" action="{{ route('steps.store') }}">
        @csrf
        <div class="row">

            <div class="col-md-6"><!-- Start cart -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('steps.index') }}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Основные данные</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="active" name="active" checked="">
                                <label for="active" class="custom-control-label">Элемент активен</label>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-6">

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="obligatory" id="obligatory"  type="checkbox" checked="">
                                        <label class="custom-control-label" for="obligatory" >Шаг обязателен</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="extra" id="extra" type="checkbox">
                                        <label class="custom-control-label" for="extra">Доплнительный ответ</label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="50" placeholder="50">
                            </div>
                            <label for="sort" class="col-sm-4 col-form-label">Сортировка</label>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-12 col-form-label">Название вопроса</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"   value="{{ old('name') }}" placeholder="Название характеристики">
                            </div>
                        </div>

                        <div class="form-group  col-md-6">
                            <label for="type">Тип вопросов</label>
                            <select id="type" name="type" class="form-control">
                                <option value="radio" selected>Только один ответ</option>
                                <option value="checkbox">Несколько ответов</option>
                                <option value="left">Только тестовое поле</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="advice">Совет специалиста</label>
                            <textarea class="form-control" id="advice" name="advice" rows="7" placeholder="Тестовое сообщение...">{{ old('advice') }}</textarea>
                        </div>

                    </div>

                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div><!--//END Основные данные -->

            </div><!-- END ROW -->


            <div class="col-md-6 d-flex align-items-stretch"><!-- Новый ряд - правый -->

                <div class="card flex-fill">
                    <div class="card-header">
                        <h3 class="card-title">Характеристики товара</h3>
                    </div>
                    <div class="card-body">
                        <div id="propertiesList">
                            @for ($i = 0; $i < 10; $i++)
                                <div class="form-group row">
                                    <div class="col-sm-10 text-lg-right">
                                        <input type="text" name="questions[{{ $i }}][name]" value="{{ old('questions['. $i.'][name]')}}" class="form-control" placeholder="Вопрос...">
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <input type="number" name="questions[{{ $i }}][sort]" value="{{ old('questions['.$i.'][sort]') }}" class="form-control" placeholder="50">
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="row pt-3">
                            <div class="col-6"><button class="btn btn-outline-secondary btn-sm" id="addProperties">Добавить</button></div>
                        </div>
                        <template id="tmplProperty">
                            <div class="form-group row">
                                <div class="col-sm-10 text-lg-right">
                                    <input type="text" name="questions[100][name]"  class="form-control name" placeholder="Вопрос...">
                                </div>
                                <div class="col-sm-2 d-flex align-items-center">
                                    <input type="number" name="questions[100][sort]" class="form-control value" placeholder="50">
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="card-footer clearfix"><p></p>
                    </div>
                </div><!-- END Характеристики товара -->

            </div><!-- END ROW col-6 -->
        </div><!-- END ROW col-12 -->
        <button type="submit" class="btn btn-primary mt-3">Применить</button>
    </form>

@endsection

@section('scripts')
    <script>
        let count = 1;
        let namber = 100;
        document.getElementById('addProperties').addEventListener('click', function (e){
            e.preventDefault();
            let tmpl = tmplProperty.content.cloneNode(true);
            tmpl.querySelector('.name').setAttribute('name', 'questions['+namber+'][name]');
            tmpl.querySelector('.value').setAttribute('name', 'questions['+namber+'][sort]');
            namber++;
            document.getElementById('propertiesList').append(tmpl);
        })
    </script>
@endsection
