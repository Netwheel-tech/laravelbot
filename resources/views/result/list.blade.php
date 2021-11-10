@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Лист проголосовавших пользователей') }}</div>

                    <div class="card-body">
                        <ol>
                        @foreach($votedusers as $key => $data)
                            <li style="color: red;">
                                <p style="line-height: 0.2;color: black;">Имя пользователя: {{$data->first_name}}</p>
                                <p style="line-height: 0.2;color: black;">Фамилия: {{$data->last_name}}</p>
                                <p style="line-height: 0.2;color: black;">Никнейм {{'@'.$data->username}}</p>
                                <p style="line-height: 0.2;color: black;">Любимое время года: {{$data->year}}</p>
                            </li>
                        @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
