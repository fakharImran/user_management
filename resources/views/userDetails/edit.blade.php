@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Edit File</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-primary" href="{{ route('userDetails.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('userDetails.update', $id) }}" method="POST"  novalidate  enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $userDetail->name }}" class="form-control"
                        placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email: (if applicable)</strong>
                    <input type="email" name="email"  value="{{ $userDetail->email }}" class="form-control" placeholder="email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>DOB: <span style="color: red">*</span></strong>
                    <input type="date" name="dob"  value="{{ $userDetail->dob }}" class="form-control" placeholder="dob" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telephone: (if applicable)</strong>
                    <input type="number" name="telephone"  value="{{ $userDetail->telephone }}" class="form-control" placeholder="telephone">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Next of kin: (if applicable)</strong>
                    <input type="text" name="relation"  value="{{ $userDetail->relation }}" class="form-control" placeholder="relation" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Passport_photo: <span style="color: red">*</span></strong>
                    {{-- <input type="text" name="passport_photo"  value="{{ $userDetail->passport_photo }}" class="form-control" placeholder="passport_photo" required> --}}
                    <input type="file"  class="form-control" id="passport_photo" name="passport_photo" value="{{ $userDetail->passport_photo }}" required autocomplete="name"   >
                    <span>{{ $userDetail->passport_photo }}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group d-flex">
                   <strong>Illness: &nbsp; &nbsp; &nbsp;</strong>
                    @php
                        $ilnessArr= json_decode($userDetail->illness);
                    @endphp
                    @foreach ($ilnessArr as $item)
                    <input type="text" name="illness[]" value="{{$item}}" class="form-control" placeholder="illness"> &nbsp; &nbsp; &nbsp;
                    @endforeach
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Last Residence Address:  (if applicable)</strong>
                    <input type="text" name="address" class="form-control"  value="{{ $userDetail->address }}" placeholder="address">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Recommended Source: <span style="color: red">*</span></strong>
                    <input type="text" name="recommended_source"  value="{{ $userDetail->recommended_source }}" class="form-control" placeholder="recommended_source" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Recommended Source Address: <span style="color: red">*</span></strong>
                    <input type="text" name="recommended_source_address"  value="{{ $userDetail->recommended_source_address }}" class="form-control" placeholder="recommended_source_address" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>


    <p class="text-center text-primary"><small>Mariata Homes</small></p>
@endsection
