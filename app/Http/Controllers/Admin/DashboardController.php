<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Respondent;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showHome()
    {
        return view('pages.home', [
            'respondent_count' => Respondent::count(),
            'respondent_chart_data' => $this->getRespondentChartData(),
        ]);
    }

    private function getRespondentChartData()
    {
        // Get current year or specific year
        $year = request('year', date('Y'));

        // Get respondents count grouped by month
        $monthlyData = Respondent::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Create array for all 12 months with default 0 values
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $chartData = [];
        $chartLabels = [];

        foreach ($months as $monthNum => $monthName) {
            $chartLabels[] = $monthName;
            $chartData[] = $monthlyData[$monthNum] ?? 0;
        }

        return [
            'labels' => $chartLabels,
            'data' => $chartData,
            'total' => array_sum($chartData),
            'year' => $year
        ];
    }

    public function ajaxChartData(Request $request)
    {
        $year = $request->get('year', date('Y'));

        $monthlyData = \App\Models\Respondent::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $chartData = [];
        $chartLabels = [];

        foreach ($months as $monthNum => $monthName) {
            $chartLabels[] = $monthName;
            $chartData[] = $monthlyData[$monthNum] ?? 0;
        }

        return response()->json([
            'labels' => $chartLabels,
            'data' => $chartData,
            'total' => array_sum($chartData),
            'year' => $year
        ]);
    }

    public function ajaxDetailedChartData(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $type = $request->get('type', 'month'); // month, week, day

        $query = \App\Models\Respondent::whereYear('created_at', $year);

        switch ($type) {
            case 'week':
                $data = $query->selectRaw('WEEK(created_at) as period, COUNT(*) as count')
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get();
                break;
            case 'day':
                $data = $query->selectRaw('DAY(created_at) as period, COUNT(*) as count')
                    ->whereMonth('created_at', $request->get('month', date('n')))
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get();
                break;
            default: // month
                $data = $query->selectRaw('MONTH(created_at) as period, COUNT(*) as count')
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get();
        }

        return response()->json([
            'data' => $data,
            'type' => $type,
            'year' => $year
        ]);
    }
}
