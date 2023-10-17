@inject('markdown', 'Parsedown')
@php
  // TODO: There should be a better place for this.
  $markdown->setSafeMode(true);
@endphp

<div class="flex items-start space-x-4 my-4">
  <div class="flex-shrink-0">
    <img class="w-8 h-8 rounded-full"
      src="https://www.gravatar.com/avatar/{{ md5($comment->commenter->email ?? $comment->guest_email) }}.jpg?s=64"
      alt="{{ $comment->commenter->name ?? $comment->guest_name }} Avatar">
  </div>
  <div class="flex-1 min-w-0">
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
      {!! $markdown->line($comment->comment) !!}
    </p>
    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
      {{ $comment->commenter->first_name . ' ' . $comment->commenter->last_name ?? $comment->guest_name }}
      <small class="text-gray-600">- {{ $comment->created_at->diffForHumans() }}</small>
    </h5>

    <div class="inline-flex rounded-md shadow-sm">
      @can('reply-to-comment', $comment)
        <button data-modal-target="reply-modal-{{ $comment->getKey() }}"
          data-modal-toggle="reply-modal-{{ $comment->getKey() }}"
          class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
          type="button">
          @lang('comments::comments.reply')
        </button>
        {{-- <button data-bs-toggle="modal" data-bs-target="#reply-modal-{{ $comment->getKey() }}"
          class="btn btn-sm btn-link text-uppercase">@lang('comments::comments.reply')</button> --}}
      @endcan
      @can('edit-comment', $comment)
        <button data-modal-target="comment-modal-{{ $comment->getKey() }}"
          data-modal-toggle="comment-modal-{{ $comment->getKey() }}"
          class="px-4 py-2 text-sm font-medium text-gray-900 bg-blue-700 border-t border-b border-gray-200 hover:bg-blue-600 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-blue-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-blue-800 dark:focus:ring-blue-500 dark:focus:text-white"
          type="button">
          @lang('comments::comments.edit')
        </button>

        {{-- <button data-bs-toggle="modal" data-bs-target="#comment-modal-{{ $comment->getKey() }}"
          class="btn btn-sm btn-link text-uppercase">@lang('comments::comments.edit')</button> --}}
      @endcan
      @can('delete-comment', $comment)
        {{-- <a href="{{ route('comments.destroy', $comment->getKey()) }}"
          onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();"
          class="btn btn-sm btn-link text-danger text-uppercase">@lang('comments::comments.delete')</a> --}}
        <a href="{{ route('comments.destroy', $comment->getKey()) }}"
          onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();"
          class="px-4 py-2 text-sm font-medium text-gray-900 bg-red-700 border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-red-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-red-800 dark:focus:ring-blue-500 dark:focus:text-white">@lang('comments::comments.delete')</a>
        <form id="comment-delete-form-{{ $comment->getKey() }}"
          action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST"
          style="display: none;">
          @method('DELETE')
          @csrf
        </form>
      @endcan
    </div>

    @can('edit-comment', $comment)
      <!-- Main modal -->
      <div id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                @lang('comments::comments.edit_comment')
              </h3>
              <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="comment-modal-{{ $comment->getKey() }}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
              @method('PUT')
              @csrf
              <div class="p-6 space-y-6">
                <label for="message"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('comments::comments.update_your_message_here')</label>
                <textarea id="message" name="message" rows="4"
                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Leave a comment..." required>{{ $comment->comment }}</textarea>

                {{-- <div class="modal-body">
                <div class="form-group">
                  <label for="message">@lang('comments::comments.update_your_message_here')</label>
                  <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                </div>
              </div> --}}
              </div>
              <!-- Modal footer -->
              <div
                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="comment-modal-{{ $comment->getKey() }}" type="submit"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('comments::comments.update')</button>
                <button data-modal-hide="comment-modal-{{ $comment->getKey() }}" type="button"
                  class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">@lang('comments::comments.cancel')</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      {{-- <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
          @method('PUT')
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">@lang('comments::comments.edit_comment')</h5>
            <button type="button" class="close" data-bs-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="message">@lang('comments::comments.update_your_message_here')</label>
              <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
              <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase"
              data-dismiss="modal">@lang('comments::comments.cancel')</button>
            <button type="submit"
              class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.update')</button>
          </div>
        </form>
      </div>
    </div>
  </div> --}}
    @endcan

    @can('reply-to-comment', $comment)
      <div id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                @lang('comments::comments.reply_to_comment')
              </h3>
              <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="reply-modal-{{ $comment->getKey() }}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
              @csrf
              <div class="p-6 space-y-6">
                <label for="message"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('comments::comments.enter_your_message_here')</label>
                <textarea id="message" name="message" rows="4"
                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Leave a comment..." required></textarea>
              </div>
              <!-- Modal footer -->
              <div
                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="reply-modal-{{ $comment->getKey() }}" type="submit"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                  @lang('comments::comments.reply')</button>
                <button data-modal-hide="reply-modal-{{ $comment->getKey() }}" type="button"
                  class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">@lang('comments::comments.cancel')</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      {{-- <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1"
    role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">@lang('comments::comments.reply_to_comment')</h5>
            <button type="button" class="close" data-bs-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="message">@lang('comments::comments.enter_your_message_here')</label>
              <textarea required class="form-control" name="message" rows="3"></textarea>
              <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase"
              data-dismiss="modal">@lang('comments::comments.cancel')</button>
            <button type="submit"
              class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.reply')</button>
          </div>
        </form>
      </div>
    </div>
  </div> --}}
    @endcan

    <br />{{-- Margin bottom --}}

    <?php
    if (!isset($indentationLevel)) {
        $indentationLevel = 1;
    } else {
        $indentationLevel++;
    }
    ?>

    {{-- Recursion for children --}}
    @if ($grouped_comments->has($comment->getKey()) && $indentationLevel <= $maxIndentationLevel)
      {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
      @foreach ($grouped_comments[$comment->getKey()] as $child)
        @include('comments::_comment', [
            'comment' => $child,
            'grouped_comments' => $grouped_comments,
        ])
      @endforeach
    @endif
  </div>
</div>


{{-- <div id="comment-{{ $comment->getKey() }}" class="media">
  <img class="mr-3"
    src="https://www.gravatar.com/avatar/{{ md5($comment->commenter->email ?? $comment->guest_email) }}.jpg?s=64"
    alt="{{ $comment->commenter->name ?? $comment->guest_name }} Avatar">
  <div class="media-body">
    <h5 class="mt-0 mb-1">{{ $comment->commenter->name ?? $comment->guest_name }} <small
        class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small></h5>
    <div style="white-space: pre-wrap;">{!! $markdown->line($comment->comment) !!}</div>

    <div>
      @can('reply-to-comment', $comment)
        <button data-bs-toggle="modal" data-bs-target="#reply-modal-{{ $comment->getKey() }}"
          class="btn btn-sm btn-link text-uppercase">@lang('comments::comments.reply')</button>
      @endcan
      @can('edit-comment', $comment)
        <button data-bs-toggle="modal" data-bs-target="#comment-modal-{{ $comment->getKey() }}"
          class="btn btn-sm btn-link text-uppercase">@lang('comments::comments.edit')</button>
      @endcan
      @can('delete-comment', $comment)
        <a href="{{ route('comments.destroy', $comment->getKey()) }}"
          onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();"
          class="btn btn-sm btn-link text-danger text-uppercase">@lang('comments::comments.delete')</a>
        <form id="comment-delete-form-{{ $comment->getKey() }}"
          action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST"
          style="display: none;">
          @method('DELETE')
          @csrf
        </form>
      @endcan
    </div>

    @can('edit-comment', $comment)
      <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1"
        role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
              @method('PUT')
              @csrf
              <div class="modal-header">
                <h5 class="modal-title">@lang('comments::comments.edit_comment')</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                  <span>&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="message">@lang('comments::comments.update_your_message_here')</label>
                  <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                  {{-- <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small> --}}
{{-- </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase"
    data-dismiss="modal">@lang('comments::comments.cancel')</button>
  <button type="submit"
    class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.update')</button>
</div>
</form>
</div>
</div>
</div> --}}
{{-- @endcan

    @can('reply-to-comment', $comment)
      <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1"
        role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title">@lang('comments::comments.reply_to_comment')</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                  <span>&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="message">@lang('comments::comments.enter_your_message_here')</label>
                  <textarea required class="form-control" name="message" rows="3"></textarea> --}}
{{-- <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small> --}}
{{-- </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase"
                  data-dismiss="modal">@lang('comments::comments.cancel')</button>
                <button type="submit"
                  class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.reply')</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endcan --}}

{{-- <br />Margin bottom --}}

<?php
// if (!isset($indentationLevel)) {
//     $indentationLevel = 1;
// } else {
//     $indentationLevel++;
// }
?>

{{-- Recursion for children --}}
{{-- @if ($grouped_comments->has($comment->getKey()) && $indentationLevel <= $maxIndentationLevel) --}}
{{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
{{-- @foreach ($grouped_comments[$comment->getKey()] as $child)
        @include('comments::_comment', [
            'comment' => $child,
            'grouped_comments' => $grouped_comments,
        ])
      @endforeach --}}
{{-- @endif --}}
{{--
  </div>
</div>  --}}

{{-- Recursion for children --}}
{{-- @if ($grouped_comments->has($comment->getKey()) && $indentationLevel > $maxIndentationLevel) --}}
{{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
{{-- @foreach ($grouped_comments[$comment->getKey()] as $child)
    @include('comments::_comment', [
        'comment' => $child,
        'grouped_comments' => $grouped_comments,
    ])
  @endforeach
@endif --}}
