@extends('template.layout')

@section('title', 'Vítejte')

@section('content')
    @foreach($invoices as $invoice)
    <div class="container-fluid bg-light w-100 mb-3">
        <div class="border-bottom h-25 bg-white p-3">
            <div>

                <div class="d-block">
                    <div>
                        <span>Název firmy: {{ $invoice->nazFirmy }} </span>
                    </div>
                    <div>
                        <span>Celková částka: {{ $invoice->sumCelkem }} </span>
                    </div>
                    <div>
                        <span>Popis: {{ $invoice->popis }}</span>
                    </div>
                </div>
                <hr class="hr">

                <div>
                    <div class="d-flex">

                        <div class="p-2 h4">Částka k rozdělení:</div>
                        <div class="border w-25 text-center border-4  rounded-2 p-2">
                            <span class="h4 fw-bold">30000{{-- $in->castka --}}</span></div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-4 d-flex flex-column text-center align-content-center">
                            <div class="m-2">
                                <select class="form-select form-select-lg mb-3">
                                    <option selected hidden value="">Vybrat sadu</option>
                                    {{--
                                     @foreach($pravidla as $pravidlo)

                                    @endforeach
                                     --}}

                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="m-0 d-flex justify-content-center">
                                <button type="button" class="btn btn-dark p-2">Rozúčtovat</button>
                            </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-7 ">
                            <table class="table border border-2">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Typ pravidla</th>
                                    <th scope="col">Hodnota</th>
                                    <th scope="col">Středisko</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Procenta</td>
                                    <td>100</td>
                                    <td>Středisko C</td>
                                </tr>
                                {{-- @foreach pravidla --}}
                                <!-- Poslední řádek s tlačítkem + -->
                                <tr>
                                    <td></td>

                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm">+</button>
                                    </td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <table class="table table-hover w-75 border">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Název</th>
                                <th scope="col">Pravidlo</th>
                                <th scope="col">Částka</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Název 1</td>
                                <td>Pravidlo 1</td>
                                <td>100 Kč</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Název 2</td>
                                <td>Pravidlo 2</td>
                                <td>200 Kč</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Název 3</td>
                                <td>Pravidlo 3</td>
                                <td>300 Kč</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Název 4</td>
                                <td>Pravidlo 4</td>
                                <td>400 Kč</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
