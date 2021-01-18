@extends('layouts.app')

@section('content')

    <main>
        <section class="text-center text-black">
            <div class="container p-5">
                    @if($picture->media_type === 'image')
                    <img src="{{$picture->url}}" class="mt-3 mb-4" style="max-width: 400px;">
                    @else
                    <iframe width="800" height="600" src="{{$picture->url}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen class="mt-3 mb-4"></iframe>
                    @endif
                    <h5>{{$picture->date}}</h5>
                    <h1 class="jumbotron-heading">{{$picture->title}}</h1>
                    @if (!empty($picture->copyright))
                    <p class="lead"> 
                        © {{$picture->copyright}}
                    </p>
                    @endif
            </div>
        </section>

        <section class="text-center text-black">
        <div class="container px-10">
            <p>{{$picture->explanation}}</p>
        </div>
        </section>
    </main>
@endsection