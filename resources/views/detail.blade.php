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
.fixed_btn{
  position: fixed;
  bottom: 10px; 
  right: 10px;
  width: 150px;
  height: 150px;
  border-radius: 50%;/*角の丸み*/
  background: skyblue; /*背景色*/
  color: black;/*文字を白に*/
  font-weight: bolder;
  border-style: solid;
  border-width: 1ex;
}
h1{
  padding: .25em 0 .25em .75em;
}
.gorgias-loaded{
  padding: 0;
}
.container{
  padding: 0;
  margin: 0;
  border: 0;
}
.bg-image {
  background-image: url('../../images/top.jpg');
  width: 100%;
  height: 100%;
  background-size: cover;
}
.bg-mask {
  height: 100%;
  background: rgba(255,255,255,0.5);
}
td {
  width: 40%;
}
</style>

@section('content')
<br>
<div class="bg-image">
  <div class="bg-mask">
    <br><br><br><br><br>
    <p class="bg-text"><h1>登山初心者でも</h1></p>
    <p class="bg-text"><h1>安全にわかりやすく登山をするための</h1></p>
    <p class="bg-text"><h1>情報共有サイトです</h1></p>
  </div>
</div>
        
<div class='container'>
        <form method="GET" action="/detail">
          <select class="btn btn-primary" name="narabi">
            <option value="asc">日付昇順で並び変え</option>
            <option value="desc">日付降順で並び変え</option>
          </select>
          <input class='btn btn-outline-primary' type="submit" value="送信">
      </form>
{{--
      {{ Form::open(['method' => 'get']) }}
    {{ csrf_field() }}
    <div class='form-group'>
        {{ Form::label('keyword', 'キーワード:') }}
        {{ Form::text('keyword', null, ['class' => 'form-control']) }}
    </div>
    <div class='form-group'>
        {{ Form::submit('検索', ['class' => 'btn btn-outline-primary'])}}
        <a href={{ route('#') }}>クリア</a>
    </div>
      {{ Form::close() }}
--}}

<table class='table table-striped table-hover'>
  @foreach ($Treks as $Trek)
    @if($loop->iteration %2 !=0)
    <tr>
    @endif
    <td>
      山の名前：<a href={{ route('detail.detail', ['id' =>  $Trek->id]) }}>
        {{ $Trek->name }}
      </a>
      　投稿者：{{ $Trek->user->name }}
      <br>
      @if ($Trek->image_url)
      <a href={{ route('detail.detail', ['id' =>  $Trek->id]) }}>
      <img src={{ str_replace('public/', 'storage/', $Trek->image_url) }} width="100%" height="auto">
      </a>
      @endif

    <!-- // ==========いいね開始========== -->

    <div class="card-body">
      <div style="display:inline-flex">
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
      </div>
        <!-- // ==========いいね終了========== --> 
        <!-- // ==========コメント開始========== -->
                    <div id="comment-post-{{ $Trek->id }}">
                      @include('post.comment_list')
                    </div>
                    <a class="light-color post-time no-text-decoration" href="/mountain/{{ $Trek->id }}">{{ $Trek->created_at }}</a>
                    <hr>

            @if (! Auth::check())
                    <div class="row actions" id="comment-form-post-{{ $Trek->id }}">
                       <form class="w-100" id="new_comment" action="{{ route('login') }}" accept-charset="UTF-8" data-remote="true" method="get"><input name="utf8" type="hidden" value="✓" />
                         {{csrf_field()}} 
                        <input type="hidden" name="user_id" />
                        <input value="{{ $Trek->id }}" type="hidden" name="$trek_id" />
                        <input class="form-control comment-input border-0" placeholder="コメントを投稿するにはログインをして下さい" autocomplete="off" type="text" name="comment" />
                      </form>
                    </div>
            @else
            <div class="row actions" id="comment-form-post-{{ $Trek->id }}">
              <form class="w-100" id="new_comment" action="/mountain/{{ $Trek->id }}/comments" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="✓" />
                {{csrf_field()}} 
               <input value="{{ Auth::user()->id }}" type="hidden" name="user_id" />
               <input value="{{ $Trek->id }}" type="hidden" name="$trek_id" />
               <input class="form-control comment-input border-0" placeholder="コメント ..." autocomplete="off" type="text" name="comment" />
             </form>
           </div>
           @endif
    <!-- // ==========コメント終了========== --> 

    </td>
    @if($loop->iteration %2 ==0)
    </tr>
    @endif
    @endforeach
  </table>
</div>

<div class="fixed_btn">
<a href={{ route('detail.new') }} class='btn'>
        <button class="fixed_btn">
            新しく登録
        </button>
      </a>
    </div>

        <div class="d-flex justify-content-center">
          {{ $Treks->links() }}
        </div>
<br><br><br>
@endsection
