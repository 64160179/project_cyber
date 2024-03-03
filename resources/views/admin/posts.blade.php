@extends('layouts.adminapp')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>กระทู้ทั้งหมด</h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>ชื่อผู้โพส</th>
                                <th>หัวข้อกระทู้</th>
                                <th>รายระเอียดกระทู้</th>
                                <th>ภาพในกระทู้</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->users_name}}</td>
                                <td>{{$post->topic}}</td>
                                <td>{{$post->details}}</td>
                                <td>
                                    <img src="{{ asset($post->post_pic) }}" style="width: 70px; height:70px;" alt="Img" />
                                </td>
                                <td>
                                    <a href="{{ url('posts/'.$post->id.'/edit') }}" class="btn btn-success mx-2">Edit</a>
                                    <a
                                        href="{{ url('posts/'.$post->id.'/delete') }}"
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
