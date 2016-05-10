<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    public $incrementing = false;
    public $table = 'fileinfo';
    public function getRouteKeyName()
{
    return 'downloadid';
}

}
