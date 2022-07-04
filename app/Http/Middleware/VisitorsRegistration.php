<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class VisitorsRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $visitor = Visitor::whereUrl(LaravelLocalization::getNonLocalizedURL())
                    ->whereIpAddress(request()->ip())
                    ->first();

        if(!$visitor) {

            $agent = new Agent();

            Visitor::create([
                'url' => LaravelLocalization::getNonLocalizedURL(),
                'ip_address' => request()->ip(),
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser()
            ]);
        }

        return $next($request);
    }
}
