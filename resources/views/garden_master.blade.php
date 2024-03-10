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



        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <label>Gardens</label>
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Name</th>
                            <th scope="col">Division Name</th>
                            <th scope="col">Price Adult</th>
                            <th scope="col">Price Child</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $count=1;
                        ?>
                        @foreach($gardens as $garden)

                            <tr>
                                <td>{{$count}}</td>
                                <td>{{$garden->name}}</td>
                                <td>{{$garden->division->name}}</td>
                                <td>{{$garden->price_adult}}</td>
                                <td>{{$garden->price_child}}</td>
                                <td>{{$garden->created_at->diffForHumans()}}</td>
                                    <?php
                                        if($garden->is_active){
                                          ?>
                                <td  style="color:green">Open</td>
                                    <?php
                                    } else
                                        {
                                        ?>
                                <td style="color:red">Not Open</td>
                                        <?php
                                    } ?>

                                <td><form method="get" action="{{route('garden_update', ['id' => $garden->id])}}">
                                        @csrf
                                        <input type="submit" value="Edit" class="btn btn-info">
                                    </form> </td>
                                <td><form method="POST" action="{{route('garden_delete')}}" onsubmit="check_delete();">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" value="{{$garden->id}}" name="id" >
                                        <input type="submit" value="delete" class="btn btn-danger">
                                    </form> </td>
                            </tr>
                                <?php $count++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <label>Garden Entry</label>
                </div>
                <script type="text/javascript">
                    function check_delete(){
                       let input=prompt('Are you Sure ? If yes enter delete')
                        if(input=='delete'){

                        }
                        else{
                            event.preventDefault();
                        }

                    }
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
                    <form action="{{route('gardens')}}" method="post"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-control">
                            <label>Select Division</label>
                            <select name="division_code" id="division_code">
                                <option value="#">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{$division->division_code}}" value="{{ old('division_code') }}">{{$division->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="form-control">
                            <label>Garden Name</label>
                            <input type="text" name="name" placeholder="Enter Garden Name" >
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-control">
                            <label>Price For Adult</label>
                            <input type="text" name="price_adult" id="price_adult" value="{{ old('price_adult') }}" placeholder="Price For Adult">
                        </div>
                        @error('price_adult')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-control">
                            <label>Price For Child</label>
                            <input type="text" name="price_child" id="price_child"  placeholder="Price For Childs">
                        </div>
                        <div class="form-control">
                            <label>Status</label>
                            <select  name="is_active" >
                           <option value="true" Selected>Open</option>
                                <option value="false">Not Open</option>
                            </select>
                        </div>
                        @error('price_child')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-control">
                            <label>Park photograph</label>
                            <input type="file" name="file">
                        </div>
                        @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-control">
                            <input style="width: 70px;" type="submit" value="Add" class="btn btn-primary">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
