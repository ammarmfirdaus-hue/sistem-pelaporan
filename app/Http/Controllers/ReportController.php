<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Services\ReportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function create(Request $request): View
    {
        return view('reports.create', [
            'user' => $request->user()->load('posyandu'),
        ]);
    }

    public function store(StoreReportRequest $request, ReportService $reportService): RedirectResponse
    {
        $reportService->store($request->user(), $request->validated());

        return redirect()->route('reports.success');
    }

    public function success(): View
    {
        return view('reports.success');
    }
}
