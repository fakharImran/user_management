@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Filing</h2>
            </div>
            <div class="float-end">
                @can('file-create')
                    <a class="btn btn-success" href="{{ route('userDetails.create') }}"> Create new File</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    {{-- {{dd($userDetails)}} --}}

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            @if (Auth::user()->hasRole('Admin'))
                <th>User ID</th>
            @endif
            <th>Name</th>
            <th>Email</th>
            <th>DOB</th>
            <th>Telephone</th>
            <th>Next of kin</th>
            <th>Passport_photo</th>
            <th width="400px">Illness</th>
            <th>Address</th>
            <th>Recommended Source</th>
            <th>Recommended Source Address</th>

            <th width="280px">Action</th>
        </tr>
        @foreach ($userDetails as $userDetail)
            <tr>
                <td>{{ ++$i }}</td>
                @if (Auth::user()->hasRole('Admin'))
                    <td> {{$userDetail->user_id}}</td>
                @endif
                <td>{{ $userDetail->name }}</td>
                <td>{{ $userDetail->email }}</td>
                <td>{{ $userDetail->dob }}</td>
                <td>{{ $userDetail->telephone }}</td>
                <td>{{ $userDetail->relation }}</td>
               
                <td  class="tdclass">
                    @php
                        if($userDetail->passport_photo!=null)
                        {
                            $imagePath = asset('storage/' . $userDetail->passport_photo);
                            echo "<img width='100' src='$imagePath' onclick='displayFullScreenImage(\"$imagePath\")' />";
                        }
                        else {
                            echo "N/A";
                        }
                    @endphp     
                    </td>  


                <td>
                    @foreach (json_decode($userDetail->illness) as $item)
                        {{ $item }},<br>
                    @endforeach
                </td>
                <td>{{ $userDetail->address }}</td>
                <td>{{ $userDetail->recommended_source }}</td>
                <td>{{ $userDetail->recommended_source_address }}</td>




                <td>
                    <form action="{{ route('userDetails.destroy', $userDetail->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('userDetails.show', $userDetail->id) }}">Show</a>
                        @can('file-edit')
                            <a class="btn btn-primary" href="{{ route('userDetails.edit', $userDetail->id) }}">Edit</a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('file-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


    {!! $userDetails->links() !!}


    <p class="text-center text-primary"><small>Mariata Homes</small></p>
@endsection
