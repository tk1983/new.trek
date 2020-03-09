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

                        <div class="col-md-8 col-md-2 mx-auto">
                            <div class="card-wrap">
                              <div class="card">
                        <div class="card-body">
                            <div class="row parts">
                              <div id="like-icon-post-{{ $Trek->id }}">
                                @if ($Trek->likedBy(Auth::user())->count() > 0)
                                  <a class="loved hide-text" data-remote="true" rel="nofollow" data-method="DELETE" href="/likes/{{ $Trek->likedBy(Auth::user())->firstOrFail()->id }}">いいねを取り消す</a>
                                @else
                                  <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="/mountain/{{ $Trek->id }}/likes">いいね</a>
                                @endif
                              </div>
                              <a class="comment" href="#"></a>
                            </div>
                            <div id="like-text-post-{{ $Trek->id }}">
                              @include('post.like_text')  
                            </div>
                            <div>
                              <span><strong>{{ $Trek->user->name }}</strong></span>
                              <span>{{ $Trek->caption }}</span>
                            </div>
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
