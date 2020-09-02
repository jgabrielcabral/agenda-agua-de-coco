@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Agendamentos') }}
                    <a class="btn btn-sm btn-fill btn-primary float-right" href="{{route('schedules.create')}}">Novo</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="list-group m-1">
                        @foreach ($schedules as $schedule)
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <span class="col col-4 m-1">{!!'<b>Auditório:</b><br>'.$schedule->auditorium->name!!}</span>
                                    <span class="col col-5 m-1">{!!'<b>Período:</b><br>'.$schedule->init->format('d/m/Y H:i').' até '.$schedule->end->format('d/m/Y H:i')!!}</span>
                                    <span class="col col-3 m-1">{!!'<b>Usuário:</b><br>'.$schedule->user->name!!}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="m-1">
                                        <a class="btn btn-sm btn-fill btn-primary" href="{{route('schedules.edit', $schedule)}}">{{ __('Editar') }}</a>
                                    </span>
                                    <span class="m-1">
                                        <form action="{{route('schedules.destroy', $schedule)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-fill btn-primary" type="submit" onclick="return confirm('Tem certeza que deseja cancelar?')">{{ __('Cancelar') }}</button>
                                        </form>
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-center align-items-center">
                    {{ $schedules->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
