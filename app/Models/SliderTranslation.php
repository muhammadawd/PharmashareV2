<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{

    protected $fillable = ['title', 'description', 'language', 'slide_id'];
    protected $table = 'slider_translations';
}
