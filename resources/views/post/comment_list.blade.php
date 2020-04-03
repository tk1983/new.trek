@foreach ($Trek->comments as $comment)
  <div class="mb-2 comment-block">
    <div class="comment">
        @if ($is_image)
            <figure>
              <img class="face" src="/storage/profile_images/{{ Auth::id() }}.jpg" width="50px" height="50px">
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
            <div class="form">
            <form method="post" action="/comments/{{ $comment->id }}">
              {{ csrf_field() }}
              <input type="submit" value="削除" class="btn btn-danger btn-sm" onclick='return confirm("本当に削除しますか？");'>
              </form>
            </div>
            </div>
        @endif
    @endif
@endforeach
<style type="text/css">
    .face{
        border-radius: 50%;/*角の丸み*/
    }
    .comment-block {
        display: flex;
        justify-content: space-between;
    }
    .comment {
        display: flex;
        flex-direction: row;
    }
</style>