@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container w-75 mx-auto mt-5">
        <div class="row">
            <div class="col-md-8">
                <img src="{{ asset($post->image )}}" class="img-fluid {{ $post->filter }}" width="100%" style="height:600px;" alt="">
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="row ">
                        <div class="col-md-2">
                            <img src="{{ asset(Auth::user()->image) }}" width="50" class=" rounded-circle p-3" alt="...">
                        </div>
                        <div class="col-md-7">
                            <h3 class="text-left mt-4"> {{ Auth::user()->name }}</h3>
                        </div>
                        <div class="col-md-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle p-2" style="font-size: 16px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ...
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#exampleModal2">Edit Title </button>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <button class="dropdown-item" type="submit">Delete Post</button>
                            </form>


                                <!-- Button trigger modal -->




                            </div>
                        </div>
                    </div>
                    </div>


                    <!-- Modal -->
            <div class="modal fade " id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit Caption</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('posts.update', $post->id) }}" method="post">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label for="Edit Caption">Edit Caption</label>
                                    <input name="title" type="text" class="form-control" id="Edit Caption" value="{{ $post->title }}">
                                </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                    <div class="card-body">
                    <p class="card-text">{{ $post->title }}</p>
                    </div>
                    <ul class="list-group list-group-flush" style="list-style: none">
                        <h3>Comments</h3>
                        @foreach ($comments as $comment)
                            <li>
                                <div class="pr-2 pl-2 pt-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                        <img src="{{ asset($comment->user->image) }}" width="50" class="rounded-circle p-3" alt="...">
                                    </div>
                                        <div class="col-md-7">
                                            <h3 class="text-left mt-4">{{ $comment->user->name }}</h3>
                                            <p>{{ $comment->body }} </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>


                    <div class="card-body">
                    <form action="" method="post">

                        <div class="com1">

                            <input placeholder="Write a comment ..." type="text" name="comment" class="form-control lg">
                        </div>
                        <div class="com1">
                            <button type="submit" class="btn btn-primary">Comment</button>

                        </div>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
