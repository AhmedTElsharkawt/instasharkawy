@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mt-5 mb-5">Add Post</h1>


    <div class="row">

        <div class="col-md-6">
            <div class="img-container text-center">
                <img id="output" src="{{ asset('images/upload.jpg') }}" width="100%" alt="">
            </div>
        </div>

        <div class="col-md-6">
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" class="createform p-5 w-100 mx-auto">
                @csrf
                @method('post')
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                    <label>Upload Image</label>
                    <input onchange="loadFile(event)" id="image" type="file" name="image"  class="form-control">
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">

                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <h4><b>Choose a filter<b></h4>
                    <input hidden id="filter1" type="radio" name="filter" value="filter1"  onclick="ChangeFilter('1')"/>
                    <label class="btn btn-dark" for="filter1">Black & White</label>

                    <input hidden id="filter2" type="radio" name="filter" value="filter2"  onclick="ChangeFilter('2')"/>
                    <label class="btn btn-dark" for="filter2">Saturate</label>

                    <input hidden id="filter3" type="radio" name="filter" value="filter3"  onclick="ChangeFilter('3')"/>
                    <label class="btn btn-dark" for="filter3">Brightness</label>

                    <input hidden id="filter4" type="radio" name="filter" value="filter4"  onclick="ChangeFilter('4')"/>
                    <label class="btn btn-dark" for="filter4">Invert</label>

                    <input hidden id="filter5" type="radio" name="filter" value="filter5"  onclick="ChangeFilter('5')"/>
                    <label class="btn btn-dark" for="filter5">Hue Rotate</label>

                    <input hidden id="filter0" type="radio" name="filter" value="filter0"  onclick="ChangeFilter('0')"/>
                    <label class="btn btn-dark" for="filter0">Orginal</label>
                </div>

                <button type="submit" class="btn btn-dark p-2 w-100" style="background-color: black; color: #fff;">Submit</button>
            </form>
        </div>
    </div>


</div>
@endsection

