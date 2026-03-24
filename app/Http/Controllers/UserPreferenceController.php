<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    //

    public function update(Request $request)
    {

        $user = Auth::user();

        $preference = UserPreference::updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [

                'layout' => $request->layout ?? 'vertical',
                'theme' => $request->theme ?? 'default',
                'color_scheme' => $request->color_scheme ?? 'light',
                'sidebar_visibility' => $request->sidebar_visibility ?? 'show',
                'sidebarUserProfile' =>$request->sidebarUserProfile ?? 'hide',
                'layout_width' => $request->layout_width ?? 'fluid',
                'layout_position' => $request->layout_position ?? 'fixed',
                'topbar_color' => $request->topbar_color ?? 'light',
                'sidebar_size' => $request->sidebar_size ?? 'lg',
                'sidebar_view' => $request->sidebar_view ?? 'default',
                'sidebar_color' => $request->sidebar_color ?? 'light',
                'sidebar_image' => $request->sidebar_image ?? 'default',
                'primary_color' => $request->sidebar_color ?? 'default',
                'preloader' => $request->preloader ?? 'disable',


            ]
        );

        return response()->json(['status' => 'success']);
    }
}
