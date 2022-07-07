<?php

namespace App\Models;

use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $guarded = [];

  // protected $dispatchesEvents = [

  //   'created' => PostCreated::class,

  // ];
}
