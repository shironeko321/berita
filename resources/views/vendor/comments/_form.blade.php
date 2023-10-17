<div class="card">
  <div class="card-body">
    @if ($errors->has('commentable_type'))
      <div
        class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
        role="alert">
        <span class="font-medium">{{ $errors->first('commentable_type') }}</span>
      </div>
      {{-- <div class="alert alert-danger" role="alert">
        {{ $errors->first('commentable_type') }}
      </div> --}}
    @endif
    @if ($errors->has('commentable_id'))
      <div
        class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
        role="alert">
        <span class="font-medium"> {{ $errors->first('commentable_id') }}
        </span>
      </div>
      {{-- <div class="alert alert-danger" role="alert">
        {{ $errors->first('commentable_id') }}
      </div> --}}
    @endif
    <form method="POST" action="{{ route('comments.store') }}">
      @csrf
      @honeypot
      <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
      <input type="hidden" name="commentable_id" value="{{ $model->getKey() }}" />

      {{-- Guest commenting --}}
      @if (isset($guest_commenting) and $guest_commenting == true)
        <div class="mb-3">
          <label for="message"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('comments::comments.enter_your_name_here')</label>
          <input type="text" id="message" name="guest_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          @error('guest_name')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
              <span class="font-medium">
                {{ $message }}
              </span>
            </p>
          @enderror
        </div>

        {{-- <div class="form-group">
          <label for="message">@lang('comments::comments.enter_your_name_here')</label>
          <input type="text"
            class="form-control @if ($errors->has('guest_name')) is-invalid @endif"
            name="guest_name" />
          @error('guest_name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
  </div> --}}


        <div class="mb-3">
          <label for="email_message"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('comments::comments.enter_your_name_here')</label>
          <input type="email" id="email_message" name="guest_email"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          @error('guest_email')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
              <span class="font-medium">
                {{ $message }}
              </span>
            </p>
          @enderror
        </div>

        {{-- <div class="form-group">
          <label for="message">@lang('comments::comments.enter_your_email_here')</label>
          <input type="email"
            class="form-control @if ($errors->has('guest_email')) is-invalid @endif"
            name="guest_email" />
          @error('guest_email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div> --}}
      @endif

      <div class="mb-3">
        <label for="message"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('comments::comments.enter_your_message_here')</label>
        <textarea id="message" name="message" rows="4"
          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Leave a comment..."></textarea>
        @error('message')
          <p class="mt-2 text-sm text-red-600 dark:text-red-500">
            <span class="font-medium">
              @lang('comments::comments.your_message_is_required')
            </span>
          </p>
        @enderror
      </div>

      {{-- <div class="form-group mb-3">
        <label for="message">@lang('comments::comments.enter_your_message_here')</label>
        <textarea class="form-control @if ($errors->has('message')) is-invalid @endif" name="message"
          rows="3"></textarea>
        <div class="invalid-feedback">
          @lang('comments::comments.your_message_is_required')
        </div> --}}
      {{-- <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small> --}}
      {{-- </div> --}}
      <button type="submit"
        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">@lang('comments::comments.submit')</button>
      {{-- <button type="submit"
        class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.submit')</button> --}}
    </form>
  </div>
</div>
<br />
