@extends('layouts.app')

@section('content')
   @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-6 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">Expressões</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-expressions-value" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">TOP 5 Expressões</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Expressão</th>
                                <th scope="col">Mês Atual</th>
                                <th scope="col">Mês Anterior</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expressionsTop5 as $expressionTop5)
                                <tr>
                                    <th scope="row">
                                        {{ $expressionTop5->expression }}
                                    </th>
                                    <td>
                                        {{ $expressionTop5->current_month }}
                                    </td>
                                    <td>
                                        {{ $expressionTop5->last_month }}
                                    </td>
                                    <td>
                                        @if($expressionTop5->current_month > $expressionTop5->last_month)
                                            <i class="fas fa-arrow-up text-success mr-3"></i>
                                        @else
                                            <i class="fas fa-arrow-down text-danger mr-3"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Melhores Instituições</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Instituição</th>
                                <th scope="col">Pessoas Felizes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($instituicoes as $instituicao)
                                <tr>
                                    <th scope="row">
                                        {{ $instituicao->nome }}
                                    </th>
                                    <td>
                                        {{ $instituicao->total }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="{{ asset('js') }}/dashboard/custom.js"></script>
@endpush
