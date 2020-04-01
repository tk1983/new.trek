@foreach ($details->comments as $comment) 
  <div class="mb-2">

    <div style="display:inline-flex">

    @if ($is_image)
    <figure>
      <img src="/storage/profile_images/{{ Auth::id() }}.jpg" width="50px" height="50px">
    </figure>
    @endif
    
    <span>
      <strong>
        <a class="no-text-decoration black-color" href="/users/{{ $comment->user->id }}">　{{ $comment->user->name }}</a>
      </strong>
    </span>
    <span>{{ $comment->comment }}</span>
  </div>
  @if (! Auth::check())
  @else
  @if ($comment->user->id == Auth::user()->id)
  <form method="post" action="/comments2/{{ $comment->id }}">
    {{ csrf_field() }}
    <input type="submit" value="削除" class="btn btn-danger btn-sm" onclick='return confirm("本当に削除しますか？");'>
    </form>
    
  </div>

  @endif
  @endif
@endforeach