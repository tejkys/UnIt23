@extends('template.layout')

@section('title', 'Vítejte')

@section('content')
    <div class="container-fluid bg-light w-100">
        <form action="{{route('testing.post')}}" id="form-1">
            <input name="value" type="text">
            <input type="submit" value="Click me">
            <div id="result"></div>
        </form>
        <script>
            $("#form-1").submit(function(e) {

                e.preventDefault();
                var form = $(this);
                var actionUrl = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(),
                    success: function(data)
                    {
                        alert(data);
                    }
                });

            });
        </script>
    </div>
@endsection
