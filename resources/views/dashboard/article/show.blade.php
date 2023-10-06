@extends('layout.index')

@section('title', $article->title)
@section('content')
    <div class="card border-0">
        <div class="card-body">
            <h3 class="card-title">{{ $article->title }}</h3>
            <h6 class="card-subtitle text-body-secondary">Create by :
                {{ $article->user[0]['first_name'] }} {{ $article->user[0]['last_name'] }}</h6>
            <span class="card-text text-body-secondary">Create at :
                {{ date('d-m-Y H:i', strtotime($article->created_at)) }}
            </span>
            <span> | </span>
            <span class="card-text text-body-secondary">Update at :
                {{ date('d-m-Y H:i', strtotime($article->updated_at)) }}
            </span>
        </div>
    </div>
    <hr>
    <div class="container">
        {!! $article->content !!}
    </div>
@endsection
