<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Services\ActivityLogService;
use App\Services\HistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function index(Request $request, HistoryService $historyService, ActivityLogService $activityLogService): View
    {
        $month = $this->normalizeMonth($request->query('month'));
        $year = $this->normalizeYear($request->query('year'));
        $hasPeriod = $month !== null && $year !== null;
        $search = trim((string) $request->query('search', ''));

        $activityLogService->record('view_history', 'history', 'Petugas melihat histori laporan.', [
            'month' => $hasPeriod ? $month : null,
            'year' => $hasPeriod ? $year : null,
            'search' => $search,
        ], $request->user());

        return view('history.index', [
            'reports' => $historyService->forUser(
                $request->user(),
                $hasPeriod ? $month : null,
                $hasPeriod ? $year : null,
                $search
            ),
            'selectedMonth' => $hasPeriod ? $month : null,
            'selectedYear' => $hasPeriod ? $year : null,
            'search' => $search,
            'yearOptions' => range((int) now()->year, (int) now()->year - 5),
        ]);
    }

    private function normalizeMonth(mixed $month): ?int
    {
        $month = filter_var($month, FILTER_VALIDATE_INT);

        return $month >= 1 && $month <= 12 ? $month : null;
    }

    private function normalizeYear(mixed $year): ?int
    {
        $year = filter_var($year, FILTER_VALIDATE_INT);
        $currentYear = (int) now()->year;

        return $year >= ($currentYear - 5) && $year <= $currentYear ? $year : null;
    }

    public function show(Request $request, Report $report, ActivityLogService $activityLogService): View
    {
        Gate::authorize('view', $report);

        $report->load(['posyandu', 'father', 'mother', 'child', 'measurement']);

        $activityLogService->record('view_report_detail', 'history', 'Petugas melihat detail laporan.', [
            'report_id' => $report->id,
        ], $request->user());

        return view('history.show', [
            'report' => $report,
        ]);
    }
}
