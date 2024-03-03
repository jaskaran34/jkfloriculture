@extends('layouts.app')

@section('content')

    <script type="text/javascript">
        function division_master(val,token){

            const form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", val);

            form.setAttribute('style', 'display: none;');

            const input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "_token");
            input.setAttribute("value", token);
            form.appendChild(input);


            document.body.appendChild(form);
            form.submit();
        }



    </script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="padding: 2%;">
        <div class="col-3" style="height: 100px;">

                <a href="{{route('division_view')}}"
                        class="btn btn-warning">
                    Division Master
                </a>
        </div>
        <div class="col-3" style="height: 100px;">

            <a href="{{route('garden_view')}}"
               class="btn btn-primary">
                Garden Master
            </a>
        </div>



    </div>
</div>
@endsection
