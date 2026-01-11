<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveRequest;
use App\Models\LeaveRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LeaveRequestController extends Controller
{
    public function index(): View
    {
        return view('leave_requests.index', [
            'leaveRequests' => Auth::user()->leaveRequests()->latest()->get()
        ]);
    }

    public function manage(): View
    {
        return view('leave_requests.manage', [
            'allRequests' => LeaveRequest::with('user')->latest()->get()
        ]);
    }

    public function store(StoreLeaveRequest $request): RedirectResponse
    {
        $request->user()->leaveRequests()->create($request->validated());

        return redirect()
            ->route('leave-requests.index')
            ->with('status', 'request-created');
    }

    public function approve(LeaveRequest $leaveRequest): RedirectResponse
    {
        if ($leaveRequest->status !== 'pending') {
            abort(403);
        }

        $leaveRequest->update(['status' => 'approved']);

        return back()->with('status', 'request-approved');
    }

    public function reject(LeaveRequest $leaveRequest): RedirectResponse
    {
        if ($leaveRequest->status !== 'pending') {
            abort(403);
        }

        $leaveRequest->update(['status' => 'rejected']);

        return back()->with('status', 'request-rejected');
    }
}
