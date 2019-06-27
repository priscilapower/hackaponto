@extends('layouts.app', ['title' => __('Instituições')])

@section('content')
    @include('instituicoes.partials.header', ['title' => __('Nova Instituição')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Instituições') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('instituicao.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para a lista') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('instituicao.store') }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Informações do Instituição') }}</h6>
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
                                <div class="form-group{{ $errors->has('latitude') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-latitude">{{ __('Latitude') }}</label>
                                    <input type="text" name="latitude" id="input-latitude" class="form-control form-control-alternative{{ $errors->has('latitude') ? ' is-invalid' : '' }}" placeholder="{{ __('Latitude') }}" value="{{ old('latitude') }}" required>

                                    @if ($errors->has('latitude'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('latitude') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('longitude') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-longitude">{{ __('Longitude') }}</label>
                                    <input type="text" name="longitude" id="input-longitude" class="form-control form-control-alternative{{ $errors->has('longitude') ? ' is-invalid' : '' }}" placeholder="{{ __('Longitude') }}" value="{{ old('longitude') }}" required>

                                    @if ($errors->has('longitude'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('longitude') }}</strong>
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
