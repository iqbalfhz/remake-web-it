<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStaffEmailRequest;
use App\Http\Requests\Admin\UpdateStaffEmailRequest;
use App\Models\StaffEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StaffEmailController extends Controller
{
    public function index(): View
    {
        $this->authorize('staff-email.view');

        $staffEmails = StaffEmail::orderBy('departemen')->paginate(20);

        return view('admin.staff-email.index', compact('staffEmails'));
    }

    public function workspace(): View
    {
        $this->authorize('workspace-email.view');

        $staffEmails = StaffEmail::whereNotNull('email_workspace')
            ->orderBy('departemen')
            ->orderBy('nama')
            ->paginate(20);

        return view('admin.workspace-email.index', compact('staffEmails'));
    }

    public function create(): View
    {
        $this->authorize('staff-email.create');

        return view('admin.staff-email.create');
    }

    public function store(StoreStaffEmailRequest $request): RedirectResponse
    {
        $this->authorize('staff-email.create');

        StaffEmail::create($request->validated());

        return redirect()->route('admin.staff-email.index')
            ->with('success', 'Data email staff berhasil ditambahkan.');
    }

    public function edit(StaffEmail $staffEmail): View
    {
        $this->authorize('staff-email.edit');

        return view('admin.staff-email.edit', compact('staffEmail'));
    }

    public function update(UpdateStaffEmailRequest $request, StaffEmail $staffEmail): RedirectResponse
    {
        $this->authorize('staff-email.edit');

        $staffEmail->update($request->validated());

        return redirect()->route('admin.staff-email.index')
            ->with('success', 'Data email staff berhasil diperbarui.');
    }

    public function destroy(StaffEmail $staffEmail): RedirectResponse
    {
        $this->authorize('staff-email.delete');
        $staffEmail->delete();

        return redirect()->route('admin.staff-email.index')
            ->with('success', 'Data email staff berhasil dihapus.');
    }
}
