<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    /**
     * Switch the application language.
     *
     * @param string $locale
     * @return RedirectResponse
     */
    public function switch($locale): RedirectResponse
    {
        // Define supported locales
        $availableLocales = ['en', 'es', 'fr', 'de', 'pt', 'it', 'ar', 'nl'];

        if (in_array($locale, $availableLocales)) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
