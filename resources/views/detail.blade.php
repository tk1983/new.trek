@extends('layout')

<style type="text/css">
.loved {
  background-image: url("/images/parts7.png");
  background-repeat: no-repeat;
  height: 36px;
  width: 36px;
  background-size: 36px !important;
}
.love {
  background-image: url("/images/parts5.png");
  background-repeat: no-repeat;
  height: 36px;
  width: 36px;
  background-size: 36px !important;
}
.hide-text {
  display: block;
  overflow: hidden;
  text-indent: 110%;
  white-space: nowrap;
}
.delete-comment {
  background-image: url("/images/parts8.png");
  background-repeat: no-repeat;
  width: 11px;
  height: 11px;
  float: right;
  margin: 5px 0 0 10px;
  background-size: 11px !important;
}
/* 
.card-wrap {
  margin: 40px 0px;
}
.parts {
  margin: 12px 0;
}
*/
</style>

@section('content')
        <h1>一覧ページ</h1>
        <table class='table table-striped table-hover'>
            <tr>
                <th>山の名前</th><th>リンク</th><th>投稿者</th>
            </tr>
            @foreach ($Treks as $Trek)
                <tr>
                    <td>{{ $Trek->name }}</td>
                    <td>
                        <a href={{ route('detail.detail', ['id' =>  $Trek->id]) }}>
                            {{ $Trek->name }}
                        </a>
                                        <!-- // ==========いいね開始========== -->
                        <div class="col-md-8 col-md-2 mx-auto">
                            <div class="card-wrap">
                              <div class="card">
                        <div class="card-body">
                            <div class="row parts">
                              <div id="like-icon-post-{{ $Trek->id }}">

                                @if (! Auth::check())
                                  <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="{{ route('login') }}">いいね</a>
                                @else

                                @if ($Trek->likedBy(Auth::user())->count() > 0)
                                  <a class="loved hide-text" data-remote="true" rel="nofollow" data-method="DELETE" href="/likes/{{ $Trek->likedBy(Auth::user())->firstOrFail()->id }}">いいねを取り消す</a>
                                @else
                                  <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="/mountain/{{ $Trek->id }}/likes">いいね</a>
                                @endif

                                @endif

                              </div>
                              <a class="comment" href="#"></a>
                            </div>
                            <div id="like-text-post-{{ $Trek->id }}">
                              @include('post.like_text')  
                            </div>
                            <!-- // ==========いいね終了========== --> 
                                        <!-- // ==========コメント開始========== -->
                                        <div id="comment-post-{{ $Trek->id }}">
                                          @include('post.comment_list')
                                        </div>
                                        <a class="light-color post-time no-text-decoration" href="/mountain/{{ $Trek->id }}">{{ $Trek->created_at }}</a>
                                        <hr>
                                        <div class="row actions" id="comment-form-post-{{ $Trek->id }}">
                                           <form class="w-100" id="new_comment" action="/mountain/{{ $Treks->id }}/comments" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="✓" />
                                             {{csrf_field()}} 
                                            <input value="{{ Auth::user()->id }}" type="hidden" name="user_id" />
                                            <input value="{{ $Trek->id }}" type="hidden" name="$trek_id" />
                                            <input class="form-control comment-input border-0" placeholder="コメント ..." autocomplete="off" type="text" name="comment" />
                                          </form>
                                        </div>
            <!-- // ==========コメント終了========== --> 
                          </div>
                        </div>
                        </div>
                        </div>

                    </td>
                    <td>{{ $Trek->user->name }}</td>
                </tr>
            @endforeach
        </table>
        <div>
            <a href={{ route('detail.new') }} class='btn btn-outline-primary'>新しく登録</a>
        <div>
<br><br><br>
@endsection
