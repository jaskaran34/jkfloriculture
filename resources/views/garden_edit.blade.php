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
                    <label>Garden Detail Update Form</label>
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
                    <form action="{{route('garden_update_form',$garden->id)}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="{{$garden->id}}">
                        <div class="form-control">
                            <label>Select Division</label>

                            <select name="division_code" id="division_code">
                                <option value="#">Select Division</option>
                                @foreach($divisions as $division)

                                    <option value="{{ $division->division_code }}" {{ $garden->division_code == $division->division_code ? 'selected' : '' }}>{{ $division->name }}</option>
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
                            <input type="text" name="name" placeholder="Enter Garden Name" value="{{$garden->name}}">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-control">
                            <label>Price For Adult</label>
                            <input type="text" name="price_adult" id="price_adult" value="{{$garden->price_adult}}" placeholder="Price For Adult">
                        </div>
                        @error('price_adult')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-control">
                            <label>Price For Child</label>
                            <input type="text" name="price_child" id="price_child" value="{{$garden->price_child}}" placeholder="Price For Childs">
                        </div>
                        @error('price_child')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-control">
                            <label>Status</label>
<!-- <?php if(!$garden->is_active){echo 'selected';} else{echo '';} ?> -->
                            <select  name="is_active" >
                                <option value="true" {{ $garden->is_active  ? 'selected' : '' }}>Open</option>
                                <option value="false" {{ $garden->is_active  ? '' : 'selected' }}>Not Open</option>
                            </select>
                        </div>
                        <div class="form-control">
                        <img src="{{asset('uploads/'.$garden->image_path)}}"  style="border: 1px solid #ddd; border-radius: 4px; padding: 5px;   width: 150px; ">
                        </div>
                        <div class="form-control">
                            <label>Park photograph</label>
                            <input type="file" name="file">
                        </div>
                        @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-control">
                            <input style="width: 70px;" type="submit" value="Update" class="btn btn-primary">
                            <input style="width: 70px;" type="button" onclick="window.location='{{ route('garden_view') }}'" value="Back" class="btn btn-success">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
