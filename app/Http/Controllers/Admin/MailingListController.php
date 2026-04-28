<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMailingListRequest;
use App\Http\Requests\Admin\UpdateMailingListRequest;
use App\Models\MailingList;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MailingListController extends Controller
{
    public function index(): View
    {
        $mailingLists = MailingList::orderBy('department')->paginate(20);

        return view('admin.mailing-list.index', compact('mailingLists'));
    }

    public function create(): View
    {
        return view('admin.mailing-list.create');
    }

    public function store(StoreMailingListRequest $request): RedirectResponse
    {
        MailingList::create($request->validated());

        return redirect()->route('admin.mailing-list.index')
            ->with('success', 'Email mailing list berhasil ditambahkan.');
    }

    public function edit(MailingList $mailingList): View
    {
        return view('admin.mailing-list.edit', compact('mailingList'));
    }

    public function update(UpdateMailingListRequest $request, MailingList $mailingList): RedirectResponse
    {
        $mailingList->update($request->validated());

        return redirect()->route('admin.mailing-list.index')
            ->with('success', 'Email mailing list berhasil diperbarui.');
    }

    public function destroy(MailingList $mailingList): RedirectResponse
    {
        $this->authorize('mailing-list.delete');
        $mailingList->delete();

        return redirect()->route('admin.mailing-list.index')
            ->with('success', 'Email mailing list berhasil dihapus.');
    }
}
