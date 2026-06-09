<?php

namespace App\Services;

use App\Models\Child;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class HistoryService
{
    public function forUser(User $user, ?int $month = null, ?int $year = null, string $search = ''): LengthAwarePaginator
    {
        $search = trim($search);

        $query = $user->reports()
            ->where('user_id', $user->id)
            ->with(['posyandu', 'mother', 'child', 'parentIdentities', 'measurement']);

        if ($month !== null && $year !== null) {
            $timezone = config('app.timezone', 'Asia/Jakarta');
            $startDate = Carbon::create($year, $month, 1, 0, 0, 0, $timezone)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth()->endOfDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if ($search !== '') {
            $normalizedSearch = mb_strtolower($search);

            $query->whereHas('child', function ($childQuery) use ($search) {
                $childQuery
                    ->where('nama', 'like', $search.'%')
                    ->orWhere('nama', 'like', '%'.$search.'%');
            })
                ->orderByDesc(
                    Child::query()
                        ->selectRaw('case when lower(nama) like ? then 1 else 0 end', [$normalizedSearch.'%'])
                        ->whereColumn('children.report_id', 'reports.id')
                        ->limit(1)
                );
        }

        return $query->latest()
            ->paginate(10)
            ->withQueryString();
    }
}
