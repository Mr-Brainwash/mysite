@extends('layouts.layout', ['title' => 'Страница 404'])
@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h3>Ой, что-то пошло не так... (Ошибка 404)</h3>
                </div>
                <div class="card-body">
                    <div class="card-img card-img_max" style="background-image: url({{'img/404.jpg'}})"></div>
                </div>
            </div>

            <a href="/" class="btn btn-outline-primary">На главную</a>
        </div>
    </div>
@endsection
