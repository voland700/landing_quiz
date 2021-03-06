@extends('admin.layouts.layout')

@section('title', 'Админ-панель - страница создания нового товара')
@section('h1', 'Новый товар')

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

    <form id="create" role="form" method="post" action="{{ route('products.store') }}"  enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-6"><!-- Start cart -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('products.index') }}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Основные данные товара</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="active" name="active" checked="">
                                <label for="active" class="custom-control-label">Товар активен</label>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-6">

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="hit" id="hit"  type="checkbox">
                                        <label class="custom-control-label" for="hit" >Хит</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="top" id="top" type="checkbox">
                                        <label class="custom-control-label" for="top">Топ</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group toggle">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="stock" id="stock"  type="checkbox">
                                        <label class="custom-control-label" for="stock">Аккция</label>
                                    </div>
                                </div>

                                <div class="form-group toggle">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="gift" id="gift" type="checkbox">
                                        <label class="custom-control-label" for="gift">Подарок</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="500" placeholder="500">
                            </div>
                            <label for="sort" class="col-sm-4 col-form-label">Сортировка</label>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-12 col-form-label">Название товра</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"   value="{{ old('name') }}" placeholder="Название характеристики">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="thumbnail">Изображение</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="img" id="img"
                                               class="custom-file-input">
                                        <label class="custom-file-label" for="img">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="source" class="col-sm-12 col-form-label">Ссылка на товар (внешняя)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="link" name="link"   value="{{ old('link') }}" placeholder="https://pechnik.su/...">
                            </div>
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
                            @foreach ($properties as $property)
                                <div class="form-group row">
                                    <div class="col-sm-6 text-lg-right">
                                        <input type="text" name="properties[{{ $property->id }}][name]" value="{{$property->name}}" class="form-control">
                                    </div>
                                    <div class="col-sm-6 d-flex align-items-center">
                                        <input type="text" name="properties[{{ $property->id }}][value]" value="{{ old('properties['.$property->id.'][value]') }}" class="form-control" placeholder="Значение...">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row pt-3">
                            <div class="col-6"><button class="btn btn-outline-secondary btn-sm" id="addProperties">Добавить</button></div>
                        </div>
                        <template id="tmplProperty">
                            <div class="form-group row">
                                <div class="col-sm-6 text-lg-right">
                                    <input type="text" name="properties[100][name]"  class="form-control name" placeholder="Название...">
                                </div>
                                <div class="col-sm-6 d-flex align-items-center">
                                    <input type="text" name="properties[100][value]" class="form-control value" placeholder="Значение...">
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="card-footer clearfix"><p></p>
                    </div>
                </div><!-- END Характеристики товара -->

            </div><!-- END ROW col-6 -->
        </div><!-- END ROW col-12 -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Описание товара</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="summary">Краткое описание товара</label>
                            <textarea class="form-control" id="summary" name="summary" rows="3" placeholder="Краткое описание товара...">{{ old('summary') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание товара</label>
                            <textarea class="form-control" id="description" name="description" rows="7" placeholder="Описание товара...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer clearfix"><p></p></div>
                </div>
            </div>
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
        tmpl.querySelector('.name').setAttribute('name', 'properties['+namber+'][name]');
        tmpl.querySelector('.value').setAttribute('name', 'properties['+namber+'][value]');
        namber++;
        document.getElementById('propertiesList').append(tmpl);
        })
    </script>
@endsection
