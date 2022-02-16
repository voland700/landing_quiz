@extends('admin.layouts.layout')

@section('title', 'Админ-панель - данные заказчика обратного звонка')
@section('h1', 'Данные заказчика')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <a href="{{route('callbacks.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
            </div>
            <div class="card-body">
                <div class="callout callout-success">
                    <h5>{{$callback->name}}</h5>
                    <ul>
                        <li><strong>Телефон:&emsp;</strong> {{$callback->phone}}</li>
                        <li>Дата заказа:&emsp;</strong> {{$callback->created_at}}</li>
                    </ul>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <p></p>
            </div>
            <!-- /.card-footer-->
        </div>
    </div>
@endsection
