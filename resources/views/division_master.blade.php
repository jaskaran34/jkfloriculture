@extends('modules')
@section('extend')



    <div class="row">
        @if(session('Message'))
            <div class="alert alert-success">
                {{ session('Message') }}
            </div>
        @endif

        <div class="col-4">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Division Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($divisions as $division)

                <tr>
                    <th scope="row">{{$division->id}}</th>
                    <td>{{$division->division_code}}</td>
                    <td>{{$division->name}}</td>
                    <td>{{$division->created_at}}</td>
                    <td><form method="POST" action="{{route('division_delete')}}">
                       @csrf
                            @method('DELETE')
                            <input type="hidden" value="{{$division->id}}" name="id" >
                            <input type="submit" value="delete" class="btn btn-danger">
                        </form> </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
            <div class="col-4">
                <form action="" method="post">

                </form>
                <div class="form-control">

                </div>
            </div>
    </div>
@endsection
