@extends('layout.master')

@section('content')
    
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

@endsection