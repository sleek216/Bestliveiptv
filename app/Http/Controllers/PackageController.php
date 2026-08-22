<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(Request $request): View
    {
        // Get all active regular packages (not reseller packages)
        $allPackages = Package::active()
            ->regular()
            ->with('features')
            ->orderBy('sort_order')
            ->get();
        
        // Group packages by duration for filtering
        $packagesByDuration = [
            'all' => $allPackages,
            '1_month' => $allPackages->filter(function($pkg) {
                return stripos($pkg->duration_label, '1 month') !== false || 
                       stripos($pkg->duration_label, '1 Month') !== false ||
                       $pkg->duration_months == 1;
            }),
            '3_months' => $allPackages->filter(function($pkg) {
                return stripos($pkg->duration_label, '3 month') !== false || 
                       stripos($pkg->duration_label, '3 Months') !== false ||
                       $pkg->duration_months == 3;
            }),
            '6_months' => $allPackages->filter(function($pkg) {
                return stripos($pkg->duration_label, '6 month') !== false || 
                       stripos($pkg->duration_label, '6 Months') !== false ||
                       $pkg->duration_months == 6;
            }),
            '12_months' => $allPackages->filter(function($pkg) {
                return stripos($pkg->duration_label, '12 month') !== false || 
                       stripos($pkg->duration_label, '12 Months') !== false ||
                       stripos($pkg->duration_label, '1 year') !== false ||
                       $pkg->duration_months == 12;
            }),
            'recharge' => $allPackages->filter(function($pkg) {
                return stripos($pkg->name, 'recharge') !== false ||
                       stripos($pkg->name, 'renewal') !== false ||
                       stripos($pkg->name, 'renew') !== false ||
                       stripos($pkg->duration_label, 'recharge') !== false;
            }),
            'lifetime' => $allPackages->filter(function($pkg) {
                return stripos($pkg->duration_label, 'lifetime') !== false ||
                       stripos($pkg->duration_label, 'Lifetime') !== false ||
                       stripos($pkg->name, 'lifetime') !== false ||
                       stripos($pkg->name, 'Lifetime') !== false ||
                       $pkg->duration_months >= 999;
            }),
        ];
        
        // Default packages to display (all packages)
        $packages = $packagesByDuration['all'];

        return view('packages.index', compact('packages', 'packagesByDuration'));
    }

    public function show(string $slug): View
    {
        $package = Package::where('slug', $slug)->active()->with('features')->firstOrFail();
        
        $relatedPackages = Package::active()
            ->where('id', '!=', $package->id)
            ->where('duration', $package->duration)
            ->with('features')
            ->take(3)
            ->get();

        return view('packages.show', compact('package', 'relatedPackages'));
    }
}
