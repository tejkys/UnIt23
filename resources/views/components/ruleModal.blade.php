
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
                            <option value="procenta">Absolutní částka</option>
                            <option value="hodnota">Celková hodnota</option>
                            <option value="zbytek">Zbytek</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlSelect2" class="form-label">Středisko</label>
                        <select class="form-select" id="resortSelect">
                            @foreach($resort as $resortItem)
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
                            $('#addRuleButton').click(function() {

                                rulesArray.push(   {
                                    id: ruleID++,
                                    type: $('#ruleTypeSelect').find(":selected").val(),
                                    value: $('#valueTextField').val(),
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
