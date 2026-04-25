<?php

namespace App\Http\Controllers;

use App\Models\MailingList;
use App\Models\StaffEmail;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailController extends Controller
{
    public function mailingList(Request $request): View
    {
        $search = $request->string('search');
        $perPage = in_array($request->integer('per_page', 50), [10, 25, 50, 100])
            ? $request->integer('per_page', 50)
            : 50;

        $mailingLists = MailingList::query()
            ->when($search, fn ($q) => $q->where('department', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%"))
            ->orderBy('department')
            ->paginate($perPage)
            ->withQueryString();

        return view('emails.mailing-list', compact('mailingLists', 'search', 'perPage'));
    }

    public function seluruhStaff(Request $request): View
    {
        $search = $request->string('search');
        $perPage = in_array($request->integer('per_page', 25), [10, 25, 50, 100])
            ? $request->integer('per_page', 25)
            : 25;

        $staffs = StaffEmail::query()
            ->when($search, fn ($q) => $q->where('nama', 'like', "%{$search}%")
                ->orWhere('departemen', 'like', "%{$search}%")
                ->orWhere('pt', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%"))
            ->orderBy('departemen')
            ->orderBy('nama')
            ->paginate($perPage)
            ->withQueryString();

        return view('emails.seluruh-staff', compact('staffs', 'search', 'perPage'));
    }

    public function workspace(Request $request): View
    {
        $search = $request->string('search');
        $perPage = in_array($request->integer('per_page', 50), [10, 25, 50, 100])
            ? $request->integer('per_page', 50)
            : 50;

        $staffs = StaffEmail::query()
            ->whereNotNull('email_workspace')
            ->when($search, fn ($q) => $q->where('nama', 'like', "%{$search}%")
                ->orWhere('departemen', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('email_workspace', 'like', "%{$search}%"))
            ->orderBy('departemen')
            ->orderBy('nama')
            ->paginate($perPage)
            ->withQueryString();

        return view('emails.workspace', compact('staffs', 'search', 'perPage'));
    }
}
