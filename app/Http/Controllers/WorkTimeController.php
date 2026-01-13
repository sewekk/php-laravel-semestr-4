<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkTimeRequest;
use App\Models\WorkTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class WorkTimeController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $query = WorkTime::with('user')->latest();

        if ($user->role === 'employee') {
            $query->where('user_id', $user->id);
        }

        $workTimes = $query->get();

        $totalMinutes = $workTimes->where('status', 'approved')->sum('duration_minutes');

        return view('work_times.index', compact('workTimes', 'totalMinutes'));
    }

    public function manage(): View
    {
        $allRequests = WorkTime::with('user')->latest()->get();

        return view('work_times.manage', compact('allRequests'));
    }

    public function store(StoreWorkTimeRequest $request): RedirectResponse
    {
        $start = Carbon::parse($request->start_at);
        $end = Carbon::parse($request->end_at);

        $duration = $start->diffInMinutes($end);

        WorkTime::create([
            'user_id' => Auth::id(),
            'start_at' => $start,
            'end_at' => $end,
            'duration_minutes' => $duration,
            'status' => 'pending',
        ]);

        return redirect()->route('work-times.index')
            ->with('status', 'work-time-added');
    }

    public function approve(WorkTime $workTime): RedirectResponse
    {
        $workTime->update([
            'status' => 'approved'
        ]);

        return back()->with('status', 'Zaakceptowano czas pracy.');
    }

    public function reject(WorkTime $workTime): RedirectResponse
    {
        $workTime->update([
            'status' => 'rejected'
        ]);

        return back()->with('status', 'Odrzucono czas pracy.');
    }
}
