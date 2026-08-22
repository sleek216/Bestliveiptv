<?php

namespace App\Http\Middleware;

use App\Services\AffiliateService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackReferral
{
    protected AffiliateService $affiliateService;

    public function __construct(AffiliateService $affiliateService)
    {
        $this->affiliateService = $affiliateService;
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if there's a referral code in the URL
        $referralCode = $request->query('ref');
        
        if ($referralCode) {
            // Set referral cookie
            $this->affiliateService->setReferralCookie($referralCode);
            
            // Increment total_clicks for this affiliate
            $affiliate = \App\Models\Affiliate::where('referral_code', $referralCode)
                ->where('is_active', true)
                ->first();
                
            if ($affiliate) {
                // To avoid spamming clicks from same user reloading, we could track in session
                // but for simple tracking, increment every time or if session doesn't have it
                if (!$request->session()->has('clicked_ref_' . $referralCode)) {
                    $affiliate->increment('total_clicks');
                    $request->session()->put('clicked_ref_' . $referralCode, true);
                }
            }
        }

        return $next($request);
    }
}
