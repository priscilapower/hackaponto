@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Olá') . ' '. auth()->user()->name,
        'description' => __('Esperamos que você tenha um bom dia! O HackaPonto agradece a preferência!'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Editar Perfil') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('profile.update') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Informações do Usuário') }}</h6>

                            <div class="pl-lg-3">
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            </div>

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-nome">{{ __('Nome') }}</label>
                                    <input type="text" name="nome" id="input-nome" class="form-control form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="{{ __('Nome') }}" value="{{ old('nome', auth()->user()->nome) }}" required autofocus>

                                    @if ($errors->has('nome'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nome') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('usuario') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-usuario">{{ __('Usuário') }}</label>
                                        <input type="text" name="usuario" id="input-usuario" class="form-control form-control-alternative{{ $errors->has('usuario') ? ' is-invalid' : '' }}" placeholder="{{ __('Usuário') }}" value="{{ old('usuario', auth()->user()->usuario) }}" required autofocus>

                                        @if ($errors->has('usuario'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('usuario') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                              <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                                </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <div class="pl-lg-4">
                                <h6 class="heading-small text-muted mb-4">{{ __('Senha') }}</h6>
                            </div>
                            @if (session('password'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Senha') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                    
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Nova senha') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirme a nova senha') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>
                            </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Mudar Senha') }}</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @include('layouts.footers.auth')

@endsection
