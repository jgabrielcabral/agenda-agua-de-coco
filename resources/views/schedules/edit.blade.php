@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Agendamento') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('schedules.update', $schedule) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="auditorium" class="col-md-4 col-form-label text-md-right">{{ __('Auditório') }}</label>

                            <div class="col-md-6">
                                <select id="auditorium" name="auditorium" class="custom-select @error('auditorium') is-invalid @enderror">
                                    <option value="">Escolha...</option>
                                    @foreach ($auditoriums->sortBy('name') as $auditorium)
                                        <option value="{{$auditorium->id}}" {{old('auditorium', $schedule->auditorium->id) == $auditorium->id ? 'selected' : ''}}>{{$auditorium->name}}</option>
                                    @endforeach
                                </select>

                                @error('auditorium')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="init" class="col-md-4 col-form-label text-md-right">{{ __('Date e Horário de Início') }}</label>

                            <div class="col-md-6">
                                <input id="init" type="dateTime-local" class="form-control @error('init') is-invalid @enderror" name="init" value="{{ old('init', $schedule->init->format('Y-m-d\TH:i:s')) }}" required autocomplete="init">

                                @error('init')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end" class="col-md-4 col-form-label text-md-right">{{ __('Date e Horário de Fim') }}</label>

                            <div class="col-md-6">
                                <input id="end" type="dateTime-local" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end', $schedule->end->format('Y-m-d\TH:i:s')) }}" required autocomplete="end">

                                @error('end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('Usuário') }}</label>

                            <div class="col-md-6">
                                <select id="user" name="user" class="custom-select @error('user') is-invalid @enderror">
                                    <option value="">Escolha...</option>
                                    @foreach ($users->sortBy('name') as $user)
                                        <option value="{{$user->id}}" {{ old('user', $schedule->user->id) == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                    @endforeach
                                </select>

                                @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Editar') }}
                                </button>
                                <a class="btn btn-danger" href="{{route('schedules.index')}}">
                                    {{ __('Voltar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
