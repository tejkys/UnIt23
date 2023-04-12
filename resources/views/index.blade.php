@extends('template.layout')

@section('title', 'Vítejte')

@section('content')
@if($valid)

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
                            <span class="h4 fw-bold" id="castka">{{$invoice->sumCelkem}}</span></div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-4 d-flex flex-column text-center align-content-center">
                            <div class="m-2">
                                <select class="form-select form-select-lg mb-3" id="selectRuleSet">
                                    <option selected hidden value="">Vybrat sadu</option>
                                    <option value="">Žádná sada</option>
                                    @foreach($ruleSets as $ruleSet)
                                        <option class="ruleSetItems" value="{{ json_encode($ruleSet) }}" {{ ($invoice->suitableRuleSet != null && $invoice->suitableRuleSet->id == $ruleSet->id ?"selected" : "") }}>{{ $ruleSet->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="m-0 d-flex justify-content-center gap-2">
                                <button id="btnResult" type="button" class="btn btn-dark p-2">Rozúčtovat</button>
                                <button id="btnSave" type="button" class="btn btn-dark p-2" style="display:none;" >Uložit sadu</button>
                                <button id="btnSaveResults" type="button" class="btn btn-success p-2" style="display:none;" >Potvrdit</button>

                            </div>
                            <div id="ruleSetParts" style="display:none;" class="w-100 mt-3">
                                <label for="ruleSetName" class="form-label m-0">Jméno sady</label>
                                <input type="text" class="form-control" id="ruleSetName"
                                       placeholder="Jméno sady">
                                <div class="w-100 pt-2 d-flex flex-column justify-content-center">
                                    <label for="descriptionPattern" class="form-label m-0">Vzorec popisu</label>
                                    <input type="text" class="form-control" id="descriptionPattern"
                                           placeholder="Vzorec popisu">
                                </div>
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
                                <tbody id="ruleTable">
                                <script>
                                    $('#selectRuleSet').change(function (){

                                        rulesArray = [];
                                        if(this.value != ""){
                                        let arrayRuleFromSet = JSON.parse(this.value);

                                            console.log(arrayRuleFromSet);
                                        arrayRuleFromSet.rules.forEach(e =>
                                        rulesArray.push(
                                            {id: e.id,
                                                type: e.rule_type,
                                                value: e.value,
                                                resort: e.resort_id
                                            }
                                    ));
                                        ruleID = arrayRuleFromSet.rules.length+1;

                                    }
                                            refresh();
                                    }
                                    );
                                    var initialPrice = {{$invoice->sumCelkem}};
                                    var rulesArray = [

                                    ];
                                    var ruleID = 1;
                                    $(document).ready(refresh());
                                    function refresh() {

                                        $('#ruleTable').find("tr:not(:last)").remove();

                                        // Loop through each rule object in the array and append a new table row
                                        $.each(rulesArray, function(index, rule) {
                                            let newRow = $('<tr>');
                                            newRow.append($('<td>').text(rule.id));
                                            newRow.append('</td>');
                                            newRow.append($('<td>').text(rule.type));
                                            newRow.append('</td>');
                                            newRow.append($('<td>').text(rule.value));
                                            newRow.append('</td>');
                                            newRow.append($('<td>').text(rule.resort));
                                            newRow.append('</td>');
                                            newRow.append('</tr>');
                                            $('#ruleTable').prepend(newRow);
                                        });
                                    };
                                </script>
                                {{-- @foreach pravidla --}}
                                <!-- Poslední řádek s tlačítkem + -->
                                <tr>
                                    <td colspan="4" class="text-center">
                                        @include('components.ruleModal')
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                        <script>
                            $('#btnResult').click(function(){
                                resultArray = [];
                                calculate();
                                refreshResults();
                                $('#btnSave').show();
                                $('#btnSaveResults').show();
                                $('#ruleSetParts').show();

                            });
                            var resultArray = [];
                            function refreshResults() {

                                $('#resultTable').html("");

                                // Loop through each rule object in the array and append a new table row
                                $.each(resultArray, function(index, result) {
                                    let newRow = $('<tr>');
                                    newRow.append($('<td>').text(result.id));
                                    newRow.append('</td>');
                                    newRow.append($('<td>').text(result.resortId));
                                    newRow.append('</td>');
                                    newRow.append($('<td>').text(result.usedRule));
                                    newRow.append('</td>');
                                    newRow.append($('<td>').text(result.price));
                                    newRow.append('</td>');
                                    newRow.append('</tr>');
                                    $('#resultTable').prepend(newRow);
                                });
                            };

                            function calculate(){
                                let sumPrice = {{ $invoice->sumCelkem }};
                                let tempPrice = sumPrice;
                                let remainingSumRule = null;
                                let idx = 1;
                                rulesArray.forEach(e =>
                                    {
                                        let result = {id: idx++, usedRule: e.id, resortId: e.resort};

                                        switch(e.type){
                                            case "procenta":
                                                result.price = sumPrice * (e.value /100);
                                                tempPrice = tempPrice - result.price;
                                                resultArray.push(result);

                                                break;
                                            case "absolutni":
                                                result.price = e.value;
                                                tempPrice = tempPrice - e.value;
                                                resultArray.push(result);
                                                break;
                                            case "hodnota":
                                                result.price = sumPrice;
                                                tempPrice = 0;
                                                resultArray.push(result);
                                                break;
                                            case "zbytek":
                                                remainingSumRule = e;
                                                idx--;
                                                break;
                                        }

                                    }
                                );

                                if(remainingSumRule != null){
                                    let result = {id: idx++, usedRule: remainingSumRule.id, resortId: remainingSumRule.resort};
                                    result.price = tempPrice;
                                    resultArray.push(result);
                                }
                            }
                            $("#btnSave").click(function(e) {

                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('rules.add-rule-set') }}",
                                    data: {
                                        'name': $("#ruleSetName").val(),
                                        'company': "{{ $invoice->nazFirmy }}",
                                        'description_patter':  $("#descriptionPattern").val(),
                                        'price': "{{ $invoice->sumCelkem }}",
                                        'rules': resultArray
                                    },
                                    success: function(data)
                                    {
                                        alert("Požadavek byl úspěšně zpracován");
                                    }
                                });

                            });
                        </script>
                    <div class="row d-flex justify-content-center mt-4">
                        <table class="table table-hover w-75 border">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Středisko</th>
                                <th scope="col">Pravidlo</th>
                                <th scope="col">Částka</th>
                            </tr>
                            </thead>
                            <tbody id="resultTable">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
 @endif
@endsection
