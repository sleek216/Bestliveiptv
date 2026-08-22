@extends('layouts.app')

@section('title', 'Affiliate Dashboard - BestLiveIPTV')

@section('content')
<div style="min-height: 100vh; background: linear-gradient(135deg, #0a0f1a 0%, #1a2332 100%); padding: 80px 20px 40px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Header -->
        <div style="text-align: center; margin-bottom: 40px;">
            <h1 style="font-size: 2.5rem; font-weight: 700; color: #fff; margin-bottom: 10px;">
                💰 Affiliate Dashboard
            </h1>
            <p style="font-size: 1.1rem; color: rgba(255,255,255,0.7);">
                Earn 20% commission on every referral sale!
            </p>
        </div>

        <!-- Stats Grid -->
        @include('partials.affiliate-stats', ['affiliate' => $affiliate, 'stats' => $stats])

        <!-- Referral Link Box -->
        <div style="background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%); border-radius: 16px; padding: 32px; margin-bottom: 40px; box-shadow: 0 10px 40px rgba(0,102,255,0.3);">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #fff; margin-bottom: 16px; display: flex; align-items: center; gap: 12px;">
                <i class="ph-fill ph-link"></i>
                Your Referral Link
            </h2>
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 20px;">
                Share this link with your friends and earn 20% commission on every sale!
            </p>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <input 
                    type="text" 
                    id="referralLink" 
                    value="{{ auth()->user()->referral_link }}" 
                    readonly
                    style="flex: 1; min-width: 300px; padding: 14px 18px; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); border-radius: 8px; color: #fff; font-family: monospace; font-size: 0.95rem;"
                >
                <button 
                    onclick="copyReferralLink()" 
                    style="padding: 14px 28px; background: #fff; color: #0066ff; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; gap: 8px;"
                    onmouseover="this.style.transform='scale(1.05)'" 
                    onmouseout="this.style.transform='scale(1)'"
                >
                    <i class="ph ph-copy"></i>
                    Copy Link
                </button>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 40px;">
            
            <a href="{{ route('affiliate.referrals') }}" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 24px; text-decoration: none; transition: all 0.3s; display: block;"
               onmouseover="this.style.background='rgba(255,255,255,0.08)'" 
               onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                <i class="ph-fill ph-users" style="font-size: 2.5rem; color: #8b5cf6; margin-bottom: 12px; display: block;"></i>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #fff; margin-bottom: 8px;">View Referrals</h3>
                <p style="color: rgba(255,255,255,0.6); margin: 0; font-size: 0.875rem;">See all users you've referred</p>
            </a>

            <a href="{{ route('affiliate.commissions') }}" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 24px; text-decoration: none; transition: all 0.3s; display: block;"
               onmouseover="this.style.background='rgba(255,255,255,0.08)'" 
               onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                <i class="ph-fill ph-currency-dollar" style="font-size: 2.5rem; color: #10b981; margin-bottom: 12px; display: block;"></i>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #fff; margin-bottom: 8px;">Commissions</h3>
                <p style="color: rgba(255,255,255,0.6); margin: 0; font-size: 0.875rem;">Track your earnings history</p>
            </a>

            <a href="{{ route('affiliate.payouts') }}" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 24px; text-decoration: none; transition: all 0.3s; display: block;"
               onmouseover="this.style.background='rgba(255,255,255,0.08)'" 
               onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                <i class="ph-fill ph-wallet" style="font-size: 2.5rem; color: #0066ff; margin-bottom: 12px; display: block;"></i>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #fff; margin-bottom: 8px;">Payouts</h3>
                <p style="color: rgba(255,255,255,0.6); margin: 0; font-size: 0.875rem;">Request withdrawal</p>
            </a>

        </div>

    </div>
</div>

<script>
function copyReferralLink() {
    const input = document.getElementById('referralLink');
    input.select();
    document.execCommand('copy');
    
    const button = event.target.closest('button');
    const originalHTML = button.innerHTML;
    button.innerHTML = '<i class="ph-fill ph-check"></i> Copied!';
    button.style.background = '#10b981';
    button.style.color = '#fff';
    
    setTimeout(() => {
        button.innerHTML = originalHTML;
        button.style.background = '#fff';
        button.style.color = '#0066ff';
    }, 2000);
}
</script>
@endsection
