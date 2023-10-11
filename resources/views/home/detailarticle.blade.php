@extends('layout.index')

@section('title', $article->title)
@section('content')
    <x-home-layout2 article>
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
        <div>
            @comments(['model' => $article])
        </div>

        @pushOnce('script')
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <script>
                    setTimeout(() => {
                        const xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('PUT', '{{ route('update.view.content', ['id' => $article->id]) }}');
                        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'));

                        xhr.send();
                    }, 30000);
                </script>
            @endPushOnce
    </x-home-layout2>
@endsection
