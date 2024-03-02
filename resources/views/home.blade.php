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

                <button
                        onclick="division_master('{{route('division_view')}}','{{ csrf_token() }}')"
                        class="btn btn-warning">
                    Division Master
                </button>
        </div>
        <div class="col-3" style="height: 100px;">
            <form method="get" action="{{route('division_view')}}">
                @csrf
                <input type="submit" value="Garden Master" class="btn btn-info">

            </form>
        </div>



    </div>
</div>
@endsection
