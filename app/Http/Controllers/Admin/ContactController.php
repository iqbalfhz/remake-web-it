<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        // Capture unread BEFORE marking as read so the notification bell still shows them
        $unreadContacts = Contact::where('is_read', false)->latest()->get();

        $contacts = Contact::latest()->paginate(5);

        Contact::where('is_read', false)->update(['is_read' => true]);

        return view('admin.contacts.index', compact('contacts', 'unreadContacts'));
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $this->authorize('contacts.delete');
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
