<?php

namespace App\Http\Controllers;

use App\Models\SalesSummary;
use Illuminate\Http\Request;

class SalesSummaryController extends Controller
{
    public function getSalesSummary()
    {
        $summaries = SalesSummary::select('item', DB::raw('SUM(unit_price * units_sold) as revenue'))
            ->groupBy('item')
            ->get()
            ->map(function ($summary) {
                return [
                    'item' => $summary->item,
                    'revenue' => $summary->revenue
                ];
            });

        return response()->json([
            'status' => 'OK',
            'items' => $summaries
        ]);
    }
}
