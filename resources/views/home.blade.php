@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Bem Vindo') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-around align-items-center">
                        <a class="btn btn-lg btn-fill btn-primary" href="{{route('schedules.index')}}">Agendamentos</a>
                        <a class="btn btn-lg btn-fill btn-primary" href="{{route('auditoriums.index')}}">Gerenciar Auditórios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
