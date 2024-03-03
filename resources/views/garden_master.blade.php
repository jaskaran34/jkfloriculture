@extends('modules')
@section('extend')



    <div class="row">
        @if(session('Message'))
            <div class="alert alert-success">
                {{ session('Message') }}
            </div>
        @endif
        @if(session('Message_deleted'))
            <div class="alert alert-danger">
                {{ session('Message_deleted') }}
            </div>
        @endif



        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <label>Gardens</label>
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Garden Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gardens as $garden)

                            <tr>
                                <th scope="row">{{$garden->id}}</th>
                                <td>{{$garden->garden_code}}</td>
                                <td>{{$garden->name}}</td>
                                <td>{{$garden->created_at}}</td>
                                <td><form method="POST" action="{{route('division_delete')}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" value="{{$garden->id}}" name="id" >
                                        <input type="submit" value="delete" class="btn btn-danger">
                                    </form> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
        <div class="col-1">
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <label>Garden Entry</label>
                </div>
                <script type="text/javascript">
                    function isPositiveNumber(value) {
                        // Check if the value is a number and greater than zero
                        return !isNaN(value) && parseFloat(value) > 0;
                    }
                    function check(){
                        division_code=document.getElementById('division_code').value;
                       if(division_code=='#')
                       {
                           alert('select division');
                           event.preventDefault(); // Prevent default form submission

                       }
                        let price_adult = document.getElementById('price_adult').value;

                        if (!isPositiveNumber(price_adult)) {
                            alert('Enter only positive numbers');
                            event.preventDefault(); // Prevent default form submission
                        }

                        let price_child = document.getElementById('price_child').value;

                        if (!isPositiveNumber(price_child)) {
                            alert('Enter only positive numbers');
                            event.preventDefault(); // Prevent default form submission
                        }

                    }
                </script>
                <div class="card-body">
                    <form action="{{route('gardens')}}" method="post" onsubmit="check();">
                        @csrf
                        <div class="form-control">
                            <label>Select Division</label>
                            <select name="division_code" id="division_code">
                                <option value="#">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{$division->division_code}}" selected>{{$division->name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-control">
                            <label>Garden Name</label>
                        <input type="text" name="name" placeholder="Enter Garden Name" value="PARK">
                        </div>
                        <div class="form-control">
                            <label>Price For Adult</label>
                            <input type="text" name="price_adult" id="price_adult" value="24" placeholder="Price For Adult">
                        </div>
                        <div class="form-control">
                            <label>Price For Child</label>
                            <input type="text" name="price_child" id="price_child" value="10" placeholder="Price For Childs">
                        </div>
                        <div class="form-control">
                            <label>Park photograph</label>
                            <input type="file" name="file">
                        </div>
                        <div class="form-control">
                        <input style="width: 70px;" type="submit" value="Add" class="btn btn-primary">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
