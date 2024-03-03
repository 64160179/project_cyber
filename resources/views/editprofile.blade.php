@extends('layouts.memberapp')

@section('content')

<!-- หน้าตั้งค่า Profile -->
<main class="container">
    <div class="align-items-center"></div>
    <div class="row">
        <div class="b-example-divider"></div>
        <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
            <div class="container mt-3">
                <h3 class="text-center">{{ Auth::user()->name }}</h3><br>
                <a href="{{ route('editprofile') }}"><button type="button" class="btn btn-secondary">Upload Profile
                        Image</button></a>
                <a href=""><button type="button" class="btn btn-secondary ">Edit Profile Image</button></a>
                <div class="bg-body ">
                    <!-- เปลี่ยน username -->
                    <div class="my-3 p-3 bg-body rounded shadow-sm border">
                        <p>Change Username</p>
                        <form action="{{ route('update-name') }}" method="post">
                            @csrf
                            <input type="text" class="form-control form-control-dark text-bg-gray"
                                placeholder="Enter your new username" aria-label="Search" name="new_name"><br>
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </form>
                    </div>
                    <!------------>
                    <!-- เปลี่ยน password -->
                    <div class="my-3 p-3 bg-body rounded shadow-sm border">
                        <p>Change Password </p>
                        <form action="{{ route('update-password') }}" method="post">
                            @csrf
                            <input type="password" class="form-control form-control-dark text-bg-gray"
                                name="new_password" placeholder="Enter your new password" required><br>
                            <input type="password" class="form-control form-control-dark text-bg-gray"
                                name="new_password_confirmation" placeholder="Confirm your new password" required><br>
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </form>
                    </div>
                    <!------------>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

<script>
    $(document).ready(function () {
        $('#myModaledit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            // Extract info from data-* attributes if needed
            // Update the modal's content accordingly
        });

        $('#myModalmore').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            // Extract info from data-* attributes if needed
            // Update the modal's content accordingly
        });
    });
</script>
