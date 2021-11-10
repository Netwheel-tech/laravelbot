@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Настройка бота') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form id="addurl" action="{{ route('result.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>url для webhook:</label>
                                <input type="url" class="form-control" id="url_callback_bot" name="url_callback_bot" value="{{ $url_callback_bot ?? ''}}">
                            </div>

                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Выбрать действие
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('addurl').submit();">Сохранить url</a>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('setwebhook').submit();">Отправить url</a>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('getwebhookinfo').submit();">Получить информацию</a>
                                </div>
                            </div>
                        </form>

                            <form id="setwebhook" action="{{ route('result.setwebhook') }}" method="post" style="display: none;">
                                {{csrf_field()}}
                                <input type="hidden" name="url" value="{{ $url_callback_bot ?? '' }}">
                            </form>

                            <form id="getwebhookinfo" action="{{ route('result.getwebhookinfo') }}" method="post" style="display: none;">
                                {{csrf_field()}}
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
