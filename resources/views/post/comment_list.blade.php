@foreach ($Trek->comments as $comment) 
  <div class="mb-2">
    @if (! Auth::check())
    @else
    @if ($comment->user->id == Auth::user()->id)
    <form method="post" action="/comments/{{ $comment->id }}">
      {{ csrf_field() }}
      <input type="submit" value="削除" class="btn btn-danger btn-sm" onclick='return confirm("本当に削除しますか？");'>
      </form>

      {{-- <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/comments/{{ $comment->id }}"></a>
      --}}
    @endif
    @endif
    <span>
      <strong>
        <a class="no-text-decoration black-color" href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
      </strong>
    </span>
    <span>{{ $comment->comment }}</span>
  </div>
@endforeach