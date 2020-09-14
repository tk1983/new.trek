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
}
