@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

            </div>

        </div>


        <div class="col">


            <div class="container">
                <div class="row">
                    <div class="card" style="width: 25rem;">
                        <img src="{{ URL::asset($post->photo) }}" alt="{{ $post->photo }}" class="img-tumbnail"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text"> {{ $post->content }}</p>

                            <p>Created at : {{ $post->created_at->diffForHumans() }} </p>
                            <p>Updated at : {{ $post->updated_at->diffForHumans() }} </p>



                            @foreach ($tags as $item)
                                <label for="">{{ $item->tag }} ,</label>
                            @endforeach <br>


                            <a class="btn btn-success" href="{{ route('posts') }}"> all posts</a>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
@endsection
