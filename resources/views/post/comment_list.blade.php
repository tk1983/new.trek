@foreach ($Trek->comments as $comment) 
  <div class="mb-2">

    @if ($is_image)
    <figure>
      <img src="/storage/profile_images/{{ Auth::id() }}.jpg" width="50px" height="50px">
    </figure>
    @endif
    
    <span>
      <strong>
        <a class="no-text-decoration black-color" href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
      </strong>
    </span>
    <span>{{ $comment->comment }}</span>

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
  </div>
@endforeach