@extends('layouts.app', ['title' => __('Usuários')])

@section('content')
    @include('users.partials.header', ['title' => __('Novo Usuário')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Usuários') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para a lista') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('user.store') }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Informações do Usuário') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-nome">{{ __('Nome') }}</label>
                                    <input type="text" name="nome" id="input-nome" class="form-control form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="{{ __('Nome') }}" value="{{ old('nome') }}" required autofocus>

                                    @if ($errors->has('nome'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nome') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('usuario') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-usuario">{{ __('Usuário') }}</label>
                                    <input type="text" name="usuario" id="input-usuario" class="form-control form-control-alternative{{ $errors->has('usuario') ? ' is-invalid' : '' }}" placeholder="{{ __('Usuário') }}" value="{{ old('usuario') }}" required>

                                    @if ($errors->has('usuario'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('usuario') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Senha') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Senha') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirmação de Senha') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirmação de Senha') }}" value="" required>
                                </div>

                                <div class="form-group{{ $errors->has('foto') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-foto">{{ __('Foto ') }}</label>
                                    <input type="file" name="foto" id="input-foto" class="{{ $errors->has('foto') ? ' is-invalid' : '' }}" placeholder="{{ __('Foto') }}" value="{{ old('foto') }}" required accept="image/jpeg">

                                    @if ($errors->has('foto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('foto') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
