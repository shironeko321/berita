@php
  if (isset($approved) and $approved == true) {
      $comments = $model->approvedComments;
  } else {
      $comments = $model->comments;
  }
@endphp

@isset($perPage)
  {{ $grouped_comments->links() }}
@endisset

@auth
  @include('comments::_form')
@elseif(Config::get('comments.guest_commenting') == true)
  @include('comments::_form', [
      'guest_commenting' => true,
  ])
@else
  <div
    class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
      <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
        @lang('comments::comments.authentication_required')</h5>
    </a>
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">@lang('comments::comments.you_must_login_to_post_a_comment')</p>
    <a href="{{ route('login') }}"
      class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      @lang('comments::comments.log_in')
      <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M1 5h12m0 0L9 1m4 4L9 9" />
      </svg>
    </a>
  </div>


  {{-- <div class="card">
    <div class="card-body">
      <h5 class="card-title">@lang('comments::comments.authentication_required')</h5>
      <p class="card-text">@lang('comments::comments.you_must_login_to_post_a_comment')</p>
      <a href="{{ route('login') }}" class="btn btn-primary">@lang('comments::comments.log_in')</a>
    </div>
  </div> --}}
@endauth


@if ($comments->count() < 1)
  <div
    class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
    role="alert">
    <span class="font-medium">@lang('comments::comments.there_are_no_comments')</span>
  </div>
  {{-- <div class="alert alert-warning">@lang('comments::comments.there_are_no_comments')</div> --}}
@endif

<div>
  @php
    $comments = $comments->sortBy('created_at');

    if (isset($perPage)) {
        $page = request()->query('page', 1) - 1;

        $parentComments = $comments->where('child_id', '');

        $slicedParentComments = $parentComments->slice($page * $perPage, $perPage);

        $m = Config::get('comments.model'); // This has to be done like this, otherwise it will complain.
        $modelKeyName = (new $m())->getKeyName(); // This defaults to 'id' if not changed.

        $slicedParentCommentsIds = $slicedParentComments->pluck($modelKeyName)->toArray();

        // Remove parent Comments from comments.
        $comments = $comments->where('child_id', '!=', '');

        $grouped_comments = new \Illuminate\Pagination\LengthAwarePaginator($slicedParentComments->merge($comments)->groupBy('child_id'), $parentComments->count(), $perPage);

        $grouped_comments->withPath(request()->url());
    } else {
        $grouped_comments = $comments->groupBy('child_id');
    }
  @endphp
  @foreach ($grouped_comments as $comment_id => $comments)
    {{-- Process parent nodes --}}
    @if ($comment_id == '')
      @foreach ($comments as $comment)
        @include('comments::_comment', [
            'comment' => $comment,
            'grouped_comments' => $grouped_comments,
            'maxIndentationLevel' => $maxIndentationLevel ?? 3,
        ])
      @endforeach
    @endif
  @endforeach
</div>
