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
  .gorgias-loaded{
  padding: 0;
}
  .bg-image {
  background-image: url('../../images/top.jpg');
  background-attachment: fixed;
  background-size: cover;
  width: 100%;
  height: 100%;
  background-size: cover;
}
.bg-mask {
  height: 100%;
  background: rgba(255,255,255,0.5);
}
td {
  width: 400px;
}
</style>

<div class="bg-image">
  <div class="bg-mask">

@section('content')
<br><br><br><br>

<h1>山の名前：{{ $details->name }}</h1>

@if ($image_url)
<img src ="/{{ $image_url }}" width="100%" height="auto">
@endif

    <iframe src="https://maps.google.co.jp/maps?output=embed&q={{ $details->access }}"
        width='100%'
        height='320'
        frameborder='0'>
    </iframe>

{{--
    <div id="map" style="height: 320px; width: 80%; margin: 2rem auto 0;"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTbRzLhZD6CbK8-By6-GpvpJyBfqvp_kQ"></script>
<script type="text/javascript">
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: -34.397, //緯度を設定
            lng: 150.644 //経度を設定
        },
        zoom: 8 //地図のズームを設定
    });
</script>
--}}

<table class='table table-striped table-hover'>
    <tr>
        <td>山の名前</td>
        <td><p>{{ $details->name }}</p></td>
    </tr>
    <tr>
        <td>エリア</td>
        <td><p>{{ $details->area }}</p></td>
    </tr>
    <tr>
        <td>登山難度</td>
        <td><p>{{ $details->difficulty }}</p></td>
    </tr>            
    <tr>
        <td>住所</td>
        <td><p>{{ $details->access }}</p></td>
    </tr>            
    <tr>
      <td>日数</td>
      <td><p>{{ $details->days }}</p></td>
    <tr>
        <td>コメント</td>
        <td><p>{{ $details->gear }}</p></td>
    </tr>
</table>

<div style="display:inline-flex">
        <div>
            <a href={{ route('detail.index') }} class='btn btn-outline-primary'>一覧に戻る</a>
            @auth
                @if ($details->user_id === $login_user_id)
            　|　 <a href={{ route('detail.edit', ['id' => $details->id])}} class='btn btn-outline-primary'>編集する</a>　|　 
        </div>
        {{ Form::open(['method' => 'delete', 'route' => ['detail.destroy', $details->id]]) }}
            {{ Form::submit('削除する', ['class' => 'btn btn-outline-primary'])}}
        {{ Form::close() }}
        </div>
                @endif
            @endauth
<br>
<br>
                                <!-- // ==========いいね開始========== -->
                                 <div class="col-md-8 col-md-2 mx-auto">
                                    <div class="card-wrap">
                                      <div class="card">
                                        <div class="card-body">
                                            <div class="row parts">
                                              <div id="like-icon-post-{{ $details->id }}">
                
                                                @if (! Auth::check())
                                                  <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="{{ route('login') }}">いいね</a>
                                                @else
                
                                                @if ($details->likedBy(Auth::user())->count() > 0)
                                                  <a class="loved hide-text" data-remote="true" rel="nofollow" data-method="DELETE" href="/likes2/{{ $details->likedBy(Auth::user())->firstOrFail()->id }}">いいねを取り消す</a>
                                                @else
                                                  <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="/mountain/{{ $details->id }}/likes2">いいね</a>
                                                @endif
                                                @endif
                
                                              </div>
                                              <a class="comment" href="#"></a>
                                            </div>
                                            <div id="like-text-post-{{ $details->id }}">
                                              @include('post.like_text2')  
                                            </div>
                                            <!-- // ==========いいね終了========== --> 
                                        <!-- // ==========コメント開始========== -->
                                        <div id="comment-post-{{ $details->id }}">
                                            @include('post.comment_list2')
                                          </div>
                                          <a class="light-color post-time no-text-decoration" href="/mountain/{{ $details->id }}">{{ $details->created_at }}</a>

                                          <hr>
  
                                  @if (! Auth::check())
                                          <div class="row actions" id="comment-form-post-{{ $details->id }}">
                                             <form class="w-100" id="new_comment" accept-charset="UTF-8" data-remote="true" method="get" action="/mountain/{{ $details->id }}" ><input name="utf8" type="hidden" value="✓" />
                                               {{csrf_field()}} 
                                              <input type="hidden" name="user_id" />
                                              <input value="{{ $details->id }}" type="hidden" name="$details_id" />
                                              <input class="form-control comment-input border-0" placeholder="コメントを投稿するにはログインをして下さい" autocomplete="off" type="text" name="comment" />
                                            </form>
                                          </div>
                                  @else
                                  <div class="row actions" id="comment-form-post-{{ $details->id }}">
                                    <form class="w-100" id="new_comment" action="/mountain/{{ $details->id }}/comments2" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="✓" />
                                      {{csrf_field()}} 
                                     <input value="{{ Auth::user()->id }}" type="hidden" name="user_id" />
                                     <input value="{{ $details->id }}" type="hidden" name="$trek_id" />
                                     <input class="form-control comment-input border-0" placeholder="コメント ..." autocomplete="off" type="text" name="comment" />
                                   </form>
                                 </div>
                                 @endif       
                        </div>
                    </div>
                    </div>
              <!-- // ==========コメント終了========== --> 

            </div>
          </div>
<br>
<br>
@endsection
