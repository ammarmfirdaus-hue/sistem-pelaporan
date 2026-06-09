<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePosyanduIdentityRequest;
use App\Services\PosyanduService;
use Illuminate\Http\RedirectResponse;

class PosyanduIdentityController extends Controller
{
    public function update(UpdatePosyanduIdentityRequest $request, PosyanduService $posyanduService): RedirectResponse
    {
        $posyanduService->updateIdentity($request->user(), $request->validated());

        return redirect()
            ->route('reports.create')
            ->with('posyandu_status', 'Identitas posyandu berhasil diperbarui.');
    }
}
