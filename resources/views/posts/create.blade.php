@extends('layouts.memberapp')

@section('content')
<body>
    <div id="app">
        {{-- start create katoo --}}
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
        
                    @if (session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                    @endif
        
                    <div class="card">
                        <div class="card-header">
                            <h4>เพิ่มกระทู้</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('posts/create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
        
                                <div class="mb-3">
                                    <label>หัวข้อกระทู้ :</label>
                                    <input type="text" name="topic" class="form-control" value="{{ old('topic') }}" />
                                    @error('topic') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>รายระเอียดกระทู้ :</label>
                                    <textarea name="details" class="form-control" rows="3">{{ old('details') }}</textarea>
                                    @error('details') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>เพิ่มรูปภาพ :</label>
                                    <input type="file" name="post_pic" class="form-control" />
                                    <p class="small mb-0 mt-2"><b>Note : </b>Only JPG, JPEG, PNG files are allowed to upload.</p>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection