<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;



class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        // Set the selected locale in the session
        Session::put('locale', $locale);

        if (isset($locale)) {
            App::setLocale($locale);
        }
        return;
    }
}

