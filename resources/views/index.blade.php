@extends('layouts.app')

@section('content')

    <main>
        <section class="text-center text-black">
            <div class="container p-5">
            <a href="{{route('Show', ['id' => $potd->id])}}" style="color: inherit;">
                    @if($potd->media_type === 'image')
                    <img src="{{$potd->url}}" class="mt-3 mb-4" style="max-width: 400px;">
                    @elseif(!empty($potd->thumbs))
                    <img src="{{$potd->thumbs}}" class="mt-3 mb-4" style="max-width: 400px;">
                    @endif
                    <h5>Astronomy Picture of the Day</h5>
                    <h1 class="jumbotron-heading">{{$potd->title}}</h1>
                    @if (!empty($potd->copyright))
                    <p class="lead"> 
                        © {{$potd->copyright}}
                    </p>
                    @endif
                </a>
            </div>
        </section>

        <section class="text-center">
        <h5>More APODs (Last month)</h5>
        </section>

        <div class="my-5">
            <div class="container">
                <div class="row">
                    @foreach($otherPics as $picture)
                        <div class="col-lg-4 col-md-6 mb-4">
                        <a href="{{route('Show', ['id' => $picture->id])}}" style="color: inherit;">
                            <div class="card box-shadow mb-5">
                                @if($picture->media_type === 'image')
                                    <img class="card-img-top" src="{{$picture->url}}" alt="{{$picture->title}}">
                                @elseif(!empty($picture->thumbs))
                                    <img class="card-img-top" src="{{$picture->thumbs}}" alt="{{$picture->title}}">
                                @endif
                            <div class="card-body">
                                <h5 class="card-text" style="color: blue;">{{$picture->date}}</h5>
                                <p class="card-text">{{$picture->title}}</p>
                            </div>
                        </div>
                        </a>
                        </div>
                    @endforeach
                </div>
                <div class="row justify-content-center">
                @if(!empty($otherPics->links()))
                    <nav aria-label="pagenav">
                        {{$otherPics->links()}}
                    </nav>
                @endif
                </div>
            </div>
        </div>

    </main>

@endsection