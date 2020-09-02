@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Auditórios') }}
                    <a class="btn btn-sm btn-fill btn-primary float-right" href="{{route('auditoriums.create')}}">Novo</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="list-group m-1">
                        @foreach ($auditoriums as $auditorium)
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span>{!!'<b>Nome:</b><br>'.$auditorium->name!!}</span>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="m-1">
                                        <a class="btn btn-sm btn-fill btn-primary" href="{{route('auditoriums.edit', $auditorium)}}">{{ __('Editar') }}</a>
                                    </span>
                                    <span class="m-1">
                                        <form action="{{route('auditoriums.destroy', $auditorium)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-fill btn-primary" type="submit" onclick="return confirm('Tem certeza que deseja deletar?')">{{ __('Deletar') }}</button>
                                        </form>
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-center align-items-center">
                    {{ $auditoriums->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
