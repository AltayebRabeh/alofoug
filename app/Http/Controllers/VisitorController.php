<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $years =  Visitor::select(DB::raw('YEAR(created_at) year'))
        ->distinct()
        ->get();

        $year = $request->year ?? date('Y');

        $visitorsCount = Visitor::distinct('ip_address')
            ->count('ip_address');

        $yearCount = Visitor::distinct('ip_address')
            ->whereYear('created_at', $year)
            ->count('ip_address');

        $monthCount = Visitor::distinct('ip_address')
            ->whereMonth('created_at', date('m'))
            ->count('ip_address');

        $dayCount = Visitor::distinct('ip_address')
            ->whereDay('created_at', date('d'))
            ->count('ip_address');

        $pageVisits = Visitor::select('url', DB::raw('count(*) as total'))
            ->groupBy('url')
            ->limit(20)
            ->get();

        // Get visits in month
        $monthVisits =  Visitor::select(DB::raw('MONTHNAME(created_at) month_name'), DB::raw('MONTH(created_at) month'), DB::raw('YEAR(created_at) year'))
            ->groupBy('month_name', 'month', 'year')
            ->whereYear('created_at', $year)
            ->oldest()
            ->get();

        $monthVisits = $monthVisits->each(function($item) {
            $item->count = Visitor::distinct('ip_address')->whereYear('created_at', $item->year)->whereMonth('created_at', $item->month)->count('ip_address');
            return $item;
        });

        // Get vists browser
        $browserVisits =  Visitor::select('browser', DB::raw('YEAR(created_at) year'))
            ->distinct()
            ->whereYear('created_at', $year)
            ->get();

        $browserVisits = $browserVisits->each(function($item) {
            $item->count = Visitor::distinct('ip_address')->whereYear('created_at', $item->year)->count('ip_address');
            return $item;
        });

        // Get vists browser
        $deviceVisits =  Visitor::select('device', DB::raw('YEAR(created_at) year'))
            ->distinct()
            ->whereYear('created_at', $year)
            ->get();

        $deviceVisits = $deviceVisits->each(function($item) {
            $item->count = Visitor::distinct('ip_address')->whereYear('created_at', $item->year)->count('ip_address');
            return $item;
        });

        // Get vists platform
        $platformVisits =  Visitor::select('platform', DB::raw('YEAR(created_at) year'))
            ->distinct()
            ->whereYear('created_at', $year)
            ->get();

        $platformVisits = $platformVisits->each(function($item) {
            $item->count = Visitor::distinct('ip_address')->whereYear('created_at', $item->year)->count('ip_address');
            return $item;
        });


        return view('backend.visitors.index', compact(
            'platformVisits',
            'deviceVisits',
            'browserVisits',
            'monthVisits',
            'visitorsCount',
            'pageVisits',
            'yearCount',
            'monthCount',
            'dayCount',
            'year',
            'years'
        ));
    }
}
