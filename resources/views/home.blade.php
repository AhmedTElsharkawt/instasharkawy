@extends('layouts.app')

@section('content')
<div class="container">
    <header>

        <div class="container" style="margin-bottom: 100px;">

            <div class="profile">

                <div class="profile-image mr-5">

                    <img src="{{ Auth::user()->image }}" class="img-fluid" alt="">

                </div>

                <div class="profile-user-settings">

                    <h1 class="profile-user-name">{{ Auth::user()->name }}</h1>


                    <!-- Button trigger modal -->
                    <button type="button"  class="btn profile-edit-btn" data-toggle="modal" data-target="#exampleModal">
                        Edit Profile </button>

                    <!-- Modal -->
                    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">Edit Profile </h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('user.update', Auth::user()->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <div class="form-group text-center">
                                        <img id="output" src="images/default.png" class="rounded-circle" width="150" height="150" >
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" class="form-control" id="name" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="bio">Bio</label>
                                        <textarea name="bio" name="" id="" cols="30" rows="5" class="form-control">{!! Auth::user()->bio !!}
                                        </textarea>
                                    </div>
                                    <div class="form-group text-center">
                                        <input name="image" onchange="loadFile(event)" id="image" type="file" hidden  accept="image/*">
                                        <label class="form-check-label" for="image">
                                            <img src="{{ Auth::user()->image }}" width="100" height="100" style="cursor: pointer;" alt="">
                                        </label>
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

                    <a href="{{ route('posts.create') }}" class="btn profile-edit-btn" aria-label="profile settings"><i class="fas fa-plus" aria-hidden="true"></i></a>
                    <button class="btn profile-settings-btn" aria-label="profile settings" data-toggle="modal" data-target="#exampleModal3"><i class="fas fa-cog" aria-hidden="true"></i></button>
                    <!-- Modal -->
                    <div class="modal fade " id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Change Password</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('user.update.password')}}">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label for="password">password</label>
                                    <input name="current_password" type="password" class="form-control" id="password" placeholder="Enter old password">

                                    @error('current_password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="newpassword">New password</label>
                                    <input name="password" type="password" class="form-control" id="newpassword" placeholder="Enter new password">

                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="copassword"> Confirm password</label>
                                    <input name="password_confirmation" type="password" class="form-control" id="copassword" placeholder="Enter Confirm password">

                                    @error('password_confirmation')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
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


                </div>

                <div class="profile-stats" style="margin: 30px 0px;">

                    <ul>

                        <li><span class="profile-stat-count">{{ count($posts) }}</span> posts</li>

                        <li><span class="profile-stat-count">?</span> followers</li>
                        <li><span class="profile-stat-count">?</span> following</li>
                    </ul>

                </div>

                <div class="profile-bio" >
                    <p>
                        {!! Auth::user()->bio !!}
                    </p>
                </div>

            </div>
            <!-- End of profile section -->

        </div>
        <!-- End of container -->

    </header>

    <main>
        <div class="container">
            <div class="gallery">
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="gallery-item col-md-4" tabindex="0">
                        <a href="{{ route('posts.show', $post->id) }}">
                            <div class="outer">

                                <img src="{{ $post->image }}" class="gallery-image img-fluid {{ $post->filter }}" alt="" >
                                <div class="inner">
                                    <ul>
                                        <h3>{{ $post->title }}</h3>
                                        <li>
                                            <form action="{{ route('post.like', $post->id) }}" method="post">
                                                @csrf

                                                <button type="submit"><i class="{{ Auth::user()->likes->contains($post) ? 'fa' : 'far' }} fa-heart" aria-hidden="true"></i> {{ $post->likedBy->count() }}</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('posts.show', $post->id) }}">
                                                @csrf
                                                <button type="submit"><i class="far fa-comment" aria-hidden="true"></i> {{ $post->commetns->count() }}</button>
                                            </form>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
            <!-- End of gallery -->


        </div>
        <!-- End of container -->

    </main>
</div>
@endsection
