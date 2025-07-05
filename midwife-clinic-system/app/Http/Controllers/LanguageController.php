<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale', 'en');
        
        if (in_array($locale, ['en', 'id'])) {
            Session::put('locale', $locale);
        }
        
        return redirect()->back();
    }
}
