@extends('layouts.memberapp')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Categories</h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Topic</th>
                                <th>Details</th>
                                <th>Post Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->topic}}</td>
                                <td>{{$item->details}}</td>
                                <td>
                                    <img src="{{ asset($item->post_pic) }}" style="width: 70px; height:70px;" alt="Img" />
                                </td>
                                <td>
                                    <a href="{{ url('posts/'.$item->id.'/edit') }}" class="btn btn-success mx-2">Edit</a>
                                    <a
                                        href="{{ url('posts/'.$item->id.'/delete') }}"
                                        class="btn btn-danger mx-1"
                                        onclick="return confirm('Are you sure ?')"
                                    >
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection