<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trek extends Model
{
  protected $table = 'treks';
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function likes()
  {
    return $this->hasMany('App\Like');
  }

  public function likedBy($user)
  {
    return Like::where('user_id', $user->id)->where('trek_id', $this->id);
  }
  public function comments()
  {
    return $this->hasMany('App\Comment');
  }

  public static function order($select)
  {
    if ($select == 'asc') {
      return self::orderBy('updated_at', 'asc')->paginate(6);
    } elseif ($select == 'desc') {
      return self::orderBy('updated_at', 'desc')->paginate(6);
    } else {
      return self::paginate(6);
    }
  }
  public static function narrow_down($select)
  {
    if ($select == 'hokkaido') {
      return self::orderBy('updated_at', 'desc')->where('area', '北海道')->paginate(6);
    } elseif ($select == 'tohoku') {
      return self::orderBy('updated_at', 'desc')->where('area', '東北')->paginate(6);
    } elseif ($select == 'kanto') {
      return self::orderBy('updated_at', 'desc')->where('area', '関東')->paginate(6);
    } elseif ($select == 'chubu') {
      return self::orderBy('updated_at', 'desc')->where('area', '中部')->paginate(6);
    } elseif ($select == 'kansai') {
      return self::orderBy('updated_at', 'desc')->where('area', '関西')->paginate(6);
    } elseif ($select == 'chugoku') {
      return self::orderBy('updated_at', 'desc')->where('area', '中国')->paginate(6);
    } elseif ($select == 'shikoku') {
      return self::orderBy('updated_at', 'desc')->where('area', '四国')->paginate(6);
    } elseif ($select == 'kyushu_okinawa') {
      return self::orderBy('updated_at', 'desc')->where('area', '九州・沖縄')->paginate(6);
    } else {
      return self::paginate(6);
    }
  }
}
