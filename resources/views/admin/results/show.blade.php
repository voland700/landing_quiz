@extends('admin.layouts.layout')

@section('title', 'Админ-панель - данные заказчика - проиденного квеста')
@section('h1', 'Данные заказчика')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <a href="{{route('results.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
            </div>
            <div class="card-body">
                <div class="callout callout-info mb-3">
                    <h5><strong>Заказчик:&emsp;</strong> {{$result->name}}</h5>
                    <p><strong>Телефон:&emsp;</strong> {{$result->phone}}</p>
                    <p><strong>Дата заказа:&emsp;</strong> {{$result->created_at}}</p>
                </div>
                @foreach($data as $item)
                    <div  class="mb-1">
                        <h4>{{$loop->iteration.'.  '. $item->name }}</h4>
                        @if($item->answer)
                            <ul>
                                @foreach($item->answer as $elem)
                                    <li>{{$elem}}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if($item->extra)
                            <h6 style="padding-left: 25px;">Доплнительная информация</h6>
                            <ul><li>{{$item->extra}}</li></ul>
                        @endif
                        @if($item->message)
                            <p style="padding-left: 25px;">{{$item->message}}</p>
                        @endif
                    </div>
                @endforeach

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <p></p>
            </div>
            <!-- /.card-footer-->
        </div>
    </div>
@endsection
