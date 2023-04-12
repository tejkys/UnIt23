@extends('template.layout')

@section('title', 'Vítejte')

@section('content')
    <div class="container-fluid bg-light w-100">
        <div class="border-bottom h-25 bg-white p-3">
            <div>
                <div class="d-block">
                    <div>
                        <span>Název firmy: {{--$invoice->nazev--}} </span>
                    </div>
                    <div>
                        <span>Celková částka: {{-- $invoice->celkova_castka --}} </span>
                    </div>
                    <div>
                        <span>Popis: {{-- $invoice->popis --}}</span>
                    </div>
                </div>
                <hr class="hr">
                <div>
                    <div class="d-flex">

                        <div class="p-2 h4">Částka k rozdělení:</div>
                        <div class="border w-25 text-center border-4 border-success rounded-2 p-2">
                            <span class="h4 fw-bold">30000{{-- $in->castka --}}</span></div>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
