<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{

    protected $fillable = [

        'user_id',
        'layout',
        'theme',
        'color_scheme',
        'sidebar_size',
        'sidebar_visibility',
        'sidebarUserProfile',
        'layout_width',
        'layout_position',
        'topbar_color',
        'sidebar_view',
        'sidebar_color',
        'sidebar_image',
        'primary_color',
        'preloader',

    ];
}
