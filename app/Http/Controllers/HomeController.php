<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\ChannelCategory;
use App\Models\Setting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Get all active packages grouped by duration
        $allPackages = Package::active()
            ->with('features')
            ->orderBy('sort_order')
            ->get();
        
        // Group packages by duration for filtering
        $packagesByDuration = [
            '1_month' => $allPackages->filter(function($pkg) {
                return stripos($pkg->duration_label, '1 month') !== false || 
                       stripos($pkg->duration_label, '1 Month') !== false ||
                       $pkg->duration_months == 1;
            })->take(3),
            '3_months' => $allPackages->filter(function($pkg) {
                return stripos($pkg->duration_label, '3 month') !== false || 
                       stripos($pkg->duration_label, '3 Months') !== false ||
                       $pkg->duration_months == 3;
            })->take(3),
            '6_months' => $allPackages->filter(function($pkg) {
                return stripos($pkg->duration_label, '6 month') !== false || 
                       stripos($pkg->duration_label, '6 Months') !== false ||
                       $pkg->duration_months == 6;
            })->take(3),
            '12_months' => $allPackages->filter(function($pkg) {
                return stripos($pkg->duration_label, '12 month') !== false || 
                       stripos($pkg->duration_label, '12 Months') !== false ||
                       stripos($pkg->duration_label, '1 year') !== false ||
                       $pkg->duration_months == 12;
            })->take(3),
            'lifetime' => $allPackages->filter(function($pkg) {
                return stripos($pkg->duration_label, 'lifetime') !== false ||
                       stripos($pkg->duration_label, 'Lifetime') !== false ||
                       stripos($pkg->name, 'lifetime') !== false ||
                       stripos($pkg->name, 'Lifetime') !== false ||
                       $pkg->duration_months >= 999;
            })->take(3),
        ];
        
        // Featured packages for initial display (1 month by default)
        $featuredPackages = $packagesByDuration['1_month'];

        $testimonials = Testimonial::active()
            ->featured()
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $faqs = Faq::active()
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        $channelCategories = ChannelCategory::active()
            ->orderBy('sort_order')
            ->take(12)
            ->get();

        $stats = [
            'channels' => Setting::get('total_channels', '20,000+'),
            'countries' => Setting::get('total_countries', '150+'),
            'uptime' => Setting::get('uptime_percentage', '99.9%'),
            'support' => Setting::get('support_type', '24/7'),
        ];
        
        // Get free trial package for direct checkout link
        $freeTrialPackage = Package::active()
            ->where(function($query) {
                $query->where('duration_label', 'LIKE', '%trial%')
                      ->orWhere('name', 'LIKE', '%trial%')
                      ->orWhere('price', 0);
            })
            ->first();

        return view('home', compact(
            'featuredPackages',
            'packagesByDuration',
            'testimonials',
            'faqs',
            'channelCategories',
            'stats',
            'freeTrialPackage'
        ));
    }
}
