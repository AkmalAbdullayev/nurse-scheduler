<?php

namespace App\Http\Controllers;

use App\Enums\CallOutStatuses;
use App\Events\Admin\CallOutCreated;
use App\Http\Requests\Admin\CallOut\ConfirmRequest;
use App\Http\Requests\Admin\CallOut\StoreRequest;
use App\Http\Requests\Admin\CallOut\UpdateRequest;
use App\Models\CallOut;
use App\Models\Nurse;
use App\Models\School;
use App\Services\Admin\CallOutService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CallOutController extends Controller
{
    public function __construct(
        private readonly CallOutService $callOutService,
    )
    {
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('admin.call-out.create-call-out');
    }

    /**
     * @param ConfirmRequest $request
     * @return Factory|View|Application
     */
    public function confirm(ConfirmRequest $request): Factory|View|Application
    {
        $data = $this->callOutService->confirm($request->validated());

        return view('admin.call-out.confirm', compact(
            'data',
        ));
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->callOutService->store($request->validated(), auth()->id());

        return redirect()->route('main')->with('success');
    }

    public function school(int $schoolId): Factory|View|Application
    {
        $school = School::query()->findOrFail($schoolId);

        return view('admin.call-out.school', compact('school'));
    }

    /**
     * @param int $callOutId
     * @return Factory|View|Application
     */
    public function show(int $callOutId): Factory|View|Application
    {
        $callOut = $this->callOutService->show($callOutId)['callOut'];
        $nurses = $this->callOutService->show($callOutId)['nurses'];

        return view('admin.call-out.view', compact('callOut', 'nurses'));
    }

    /**
     * @param UpdateRequest $request
     * @param int $callOutId
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, int $callOutId): RedirectResponse
    {
        $callOut = $this->callOutService->update($request->validated(), $callOutId);

        if ($callOut['value']) {
            return redirect()->route('main')->with('message', $callOut['message']);
        }

        return back()->withInput()->with('message', $callOut['message']);
    }

    /**
     * @param Request $request
     * @param int $callOutId
     * @return RedirectResponse
     */
    public function destroy(Request $request, int $callOutId): RedirectResponse
    {
        $isDeleted = $this->callOutService->destroy(request: $request, id: $callOutId);

        if ($isDeleted) {
            return redirect()->route('main')->with('success', 'Call-out successfully deleted');
        }

        return back()->with('error');
    }
}
