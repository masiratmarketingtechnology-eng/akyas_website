<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactEnquiry::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('company_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->whereNull('read_at');
            } elseif ($request->status === 'read') {
                $query->whereNotNull('read_at');
            }
        }

        $enquiries = $query->latest()->paginate(15);

        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function show($id)
    {
        $enquiry = ContactEnquiry::findOrFail($id);

        // Mark as read
        if (is_null($enquiry->read_at)) {
            $enquiry->update(['read_at' => now()]);
        }

        return view('admin.enquiries.show', compact('enquiry'));
    }

    public function destroy($id)
    {
        $enquiry = ContactEnquiry::findOrFail($id);
        $enquiry->delete();

        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry deleted successfully.');
    }

    public function markAsRead($id)
    {
        $enquiry = ContactEnquiry::findOrFail($id);
        $enquiry->update(['read_at' => now()]);

        return redirect()->back()->with('success', 'Enquiry marked as read.');
    }
}
