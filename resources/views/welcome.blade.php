@extends('layouts.app')

@section('content')
<main class="container">
    <div>
        <h3>กระทู้</h3>
        <table class="table table-bordered table-striped">
            @foreach ($posts as $item)
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->topic }}</h5>
                        <p class="card-text">Posted by: {{ $item->users_name }}</p>
                        <p class="card-text">{{ $item->details }}</p>
                        @if($item->post_pic)
                        <img src="{{ asset($item->post_pic) }}" alt="Post Image">
                        @endif

                        @if($item->comments->count() > 0)
                        @foreach ($item->comments as $comment)
                        <li class="list-group-item">
                            <p>{{ $comment->user->name }} : {{ $comment->comment_text }}</p>
                            @if($comment->comment_pic)
                            <img src="{{ asset($comment->comment_pic) }}" alt="Comment Image">
                            @endif
                        </li>
                        @endforeach
                        @else
                        <p>No comments yet.</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </table>
    </div>
</main>
@endsection