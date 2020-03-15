@extends('layout')

<style type="text/css">
.delete-comment {
    background-image: url("/images/parts8.png");
    background-repeat: no-repeat;
    width: 11px;
    height: 11px;
    float: right;
    margin: 5px 0 0 10px;
    background-size: 11px !important;
  }

</style>


@section('content')
    
<h1>{{ $details->name }}のページ</h1>

@if ($image_url)
<img src ="/{{ $image_url }}" width="800px" height="450px">
@endif

    <iframe src="https://maps.google.co.jp/maps?output=embed&q={{ $details->name }}"
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
        <td>アクセス</td>
        <td><p>{{ $details->access }}</p></td>
    </tr>            
    <tr>
        <td>装備</td>
        <td><p>{{ $details->gear }}</p></td>
    </tr>
    <tr>
        <td>日数</td>
        <td><p>{{ $details->days }}</p></td>
</table>

        <div>
            <a href={{ route('detail.index') }} class='btn btn-outline-primary'>一覧に戻る</a>
            @auth
                @if ($details->user_id === $login_user_id)
            　|　 <a href={{ route('detail.edit', ['id' => $details->id])}} class='btn btn-outline-primary'>編集する</a>
        </div>
        {{ Form::open(['method' => 'delete', 'route' => ['detail.destroy', $details->id]]) }}
            {{ Form::submit('削除する', ['class' => 'btn btn-outline-primary'])}}
        {{ Form::close() }}
                @endif
            @endauth
<br>
<br>
                                        <!-- // ==========コメント開始========== -->
                                 <div class="col-md-8 col-md-2 mx-auto">
                                    <div class="card-wrap">
                                      <div class="card">
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

<br>
<br>
@endsection
