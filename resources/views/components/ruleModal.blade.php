
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
            data-bs-target="#exampleModal">+
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Přidání pravidla</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Typ pravidla</label>
                        <select class="form-select" id="ruleTypeSelect">
                            <option value="procenta">Procenta</option>
                            <option value="absolutni">Absolutní částka</option>
                            <option value="hodnota">Celková hodnota</option>
                            <option value="zbytek">Zbytek</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlSelect2" class="form-label">Středisko</label>
                        <select class="form-select" id="resortSelect">
                            @foreach($resorts as $resortItem)
                                <option value="{{$resortItem->id}}">{{$resortItem->nazev}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Hodnota</label>
                        <input type="text" class="form-control" id="valueTextField"
                               placeholder="Enter value">
                    </div>
                </div>
                <div class="modal-footer">
                    <form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušit</button>
                    <button type="button" class="btn btn-primary" id="addRuleButton" data-bs-dismiss="modal">Potvrdit</button>
                        <script>
                            $('#ruleTypeSelect').on('change', function() {
                                if ($(this).val() === 'hodnota' || $(this).val() === 'zbytek'){
                                    $('#valueTextField').prop("disabled", true);
                                } else {
                                    $('#valueTextField').prop("disabled", false);

                                }
                            });
                            $('#addRuleButton').click(function() {
                                let castka = $('#castka').text();
                                let result = 0;
                                switch ($('#ruleTypeSelect').find(":selected").val()){
                                    case "procenta": result = (castka - (initialPrice / 100 * $('#valueTextField').val()));break;
                                    case "absolutni": result = (castka - $('#valueTextField').val());break;
                                    case "hodnota": result = castka - initialPrice;break;
                                    case "zbytek": result = 0;break;
                                }

                                if(result >= 0){
                                    $('#castka').text(result);
                                }else{
                                    alert("Hodnota nesmí být záporná");
                                    refresh();
                                    return;

                                }
                                switch ($('#ruleTypeSelect').find(":selected").val()){
                                    case "hodnota": initialPrice;break;
                                    case "zbytek": castka;break;
                                    default : castka = $('#valueTextField').val();
                                }
                                rulesArray.push(   {
                                    id: ruleID++,
                                    type: $('#ruleTypeSelect').find(":selected").val(),
                                    value: castka,
                                    resort: $('#resortSelect').find(":selected").val()
                                });

                                refresh();

                            });
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
