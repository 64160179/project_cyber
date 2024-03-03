<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Categories
                        <a href="{{ url('categories/create') }}" class="btn btn-primary float-end">Add Category</a>
                    </h4>
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
                    <div class="my-3 p-3 bg-body rounded shadow-sm">
                        <h6 class="border-bottom pb-2 mb-0">กระทู้</h6>
                        <div class="d-flex text-body-secondary pt-3">
                            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
                            </svg>
                            <p class="pb-3 mb-0 small lh-sm border-bottom">
                                <strong class="d-block text-gray-dark"></strong>
                                Some representative placeholder content, with some information about this user. Imagine this being some sort
                                of status update, perhaps?
                            </p>
                        </div>
                        <div class="d-flex text-body-secondary pt-3">
                            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text>
                            </svg>
                            <p class="pb-3 mb-0 small lh-sm border-bottom">
                                <strong class="d-block text-gray-dark">{{ Auth::user()->name }} </strong>
                                Some more representative placeholder content, related to this other user. Another status update, perhaps.
                            </p>
                        </div>
                        <div style="display: flex; justify-content: flex-end;">
                
                            <button class="btn btn-primary rounded-pill px-3" type="button" data-bs-toggle="modal" data-bs-target="#myModalmore">more</button>
                        </div>
                        <div class="d-flex text-body-secondary pt-3">
                            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text>
                            </svg>
                            <p class="pb-3 mb-0 small lh-sm border-bottom">
                                <strong class="d-block text-gray-dark">@username</strong>
                                ตอบกลับกระทู้
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>