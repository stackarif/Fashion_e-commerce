
@extends('layouts.backend_master')
@section('title', 'Top Website Details')
@section('master_content')
<form action="{{ route('admin.website.update', $website->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
<div class="card pt-2">
    <div class="card-header ">
        <div class="d-flex justify-content-between">
        <h4 class="card-title">Top of Website Details</h4>
        <button class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Update Website Information</button>

        </div>
    </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="postTable">
                <tr>
                    <th>Title :</th>
                    <td>{{ $website->title }}</td>
                </tr>
                <tr>
                    <th>logo :</th>
                    <td><img width="100px" src="{{ asset($website->logo) }}" alt=""></td>
                    <td> <input type="file" name="logo" class="form-control"></td>
                </tr>
                
                    <th>Phone :</th>
                    <td>{{ $website->phone }}</td>
                    <td><input type="text" class="form-control" name="phone" value="{{   $website->phone }}"></td>
                </tr>
                
            </table>
        </div>
    </div>
</form>

@endsection

