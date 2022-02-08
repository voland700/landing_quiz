@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Редактирование шага квеста')
@section('h1', $step->name)

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
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
        <div class="row">


            <div class="col-md-6"><!-- Start cart -->
                <form role="form" method="post" action="{{ route('steps.update', $step->id) }}">
                    @csrf
                    @method('PUT')


                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('steps.index') }}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Основные данные</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="active" name="active" @if($step->active) checked @endif>
                                <label for="active" class="custom-control-label">Элемент активен</label>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-6">

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="obligatory" id="obligatory"  type="checkbox" @if($step->obligatory) checked @endif>
                                        <label class="custom-control-label" for="obligatory" >Шаг обязателен</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="extra" id="extra" type="checkbox" @if($step->extra) checked @endif>
                                        <label class="custom-control-label" for="extra">Доплнительный ответ</label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="{{$step->sort}}">
                            </div>
                            <label for="sort" class="col-sm-4 col-form-label">Сортировка</label>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-12 col-form-label">Название вопроса</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $step->name) }}">
                            </div>
                        </div>

                        <div class="form-group  col-md-6">
                            <label for="type">Тип вопросов</label>
                            <select id="type" name="type" class="form-control">
                                <option value="radio" @if($step->type == 'radio') selected @endif >Только один ответ</option>
                                <option value="checkbox" @if($step->type == 'checkbox') selected @endif >Несколько ответов</option>
                                <option value="text" @if($step->type == 'text') selected @endif >Только тестовое поле</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="advice">Совет специалиста</label>
                            <textarea class="form-control" id="advice" name="advice" rows="7" placeholder="Тестовое сообщение...">{{ old('advice', $step->advice) }}</textarea>
                        </div>

                    </div>

                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-primary mt-3">Обновить</button>
                    </div>
                </div><!--//END Основные данные -->
            </form>
            </div><!-- END ROW -->


            <div class="col-md-6 d-flex align-items-stretch"><!-- Новый ряд - правый -->

                <div class="card flex-fill">
                    <div class="card-header">
                        <h3 class="card-title">Вопросы квеста</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered mb-3">
                            <thead>
                                <tr>
                                    <th  style="width: 10px">ID</th>
                                    <th>Название</th>
                                    <th style="width: 100px">Редактировать</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($step->questions as $question)
                                <tr>
                                    <td class="text-center">{{$question->id}}</td>
                                    <td><a href="{{route("questions.edit", $question->id)}}">{{$question->name}}</a></td>
                                    <td>
                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form method="POST" action="{{ route('questions.destroy', $question->id) }}" class="formDelete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete" onclick="return confirm('Подтвердите удаление')"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <h6>Добавить новые вопросы</h6>
                        <form action="{{route('questions.add')}}" method="post" name="questions">
                            @csrf
                            <input type="hidden" name="step_id" value="{{$step->id}}">
                            <div id="propertiesList">
                            </div>
                            <div class="row pt-3">
                                <div class="col-6">
                                    <button class="btn btn-outline-secondary btn-sm mr-1" id="addProperties">Добавить</button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="questionsBtn" style="display: none">Обновить</button>
                                </div>
                            </div>
                        </form>
                        @csrf


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

                    <div class="card-footer clearfix"><p></p></div>
                </div><!-- END Характеристики товара -->
            </div><!-- END ROW col-6 -->
        </div><!-- END ROW col-12 -->


@endsection

@section('scripts')
    <script>
        let count = 1;
        let namber = 100;
        document.getElementById('addProperties').addEventListener('click', function (e){
            e.preventDefault();

            let questionsBtn = document.getElementById('questionsBtn');
            if(questionsBtn.style.display == 'none') questionsBtn.style.display = 'inline-block';
            let tmpl = tmplProperty.content.cloneNode(true);
            tmpl.querySelector('.name').setAttribute('name', 'questions['+namber+'][name]');
            tmpl.querySelector('.value').setAttribute('name', 'questions['+namber+'][sort]');
            namber++;
            document.getElementById('propertiesList').append(tmpl);
        })
    </script>
@endsection
