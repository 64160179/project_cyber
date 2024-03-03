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

{{-- Form for editing a post --}}
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success">{{session('status')}}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>แก้ไขกระทู้</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('posts/'.$post->id.'/admin/posts') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>หัวข้อกระทู้ :</label>
                            <input type="text" name="topic" class="form-control" value="{{ $post->topic }}" />
                            @error('topic') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>รายระเอียดกระทู้ :</label>
                            <textarea name="details" class="form-control" rows="3">{{ $post->details }}</textarea>
                            @error('details') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>รูปภาพปัจจุบัน :</label>
                            <img src="{{ asset('storage/' . $post->post_pic) }}" class="img-fluid" alt="Post Image">
                        </div>
                        <div class="mb-3">
                            <label>เลือกไฟล์รูปภาพใหม่ :</label>
                            <input type="file" name="post_pic" class="form-control" />
                            <p class="small mb-0 mt-2"><b>Note : </b>Only JPG, JPEG, PNG files are allowed to upload.</p>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
