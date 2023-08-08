<?php

namespace App\Http\Controllers\Admin;

use App\helpers\Repositories\NurseRepository;
use App\Http\Controllers\Controller;
use App\Models\Nurse;
use App\Models\School;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * @param NurseRepository $nurseRepository
     */
    public function __construct(public NurseRepository $nurseRepository)
    {
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
//        $nurses = $this->nurseRepository->all();
        $schools = School::query()->get();

        return view('nurse', compact('schools'));
    }

    /**
     * @param Request $request
     * @param int $nurse_id
     * @return mixed
     */
    public function destroy(Request $request, int $nurse_id): mixed
    {
        $nurseModel = Nurse::query()->find($nurse_id);

        return $nurseModel?->delete();
    }
}
