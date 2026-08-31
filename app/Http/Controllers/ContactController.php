<?php

namespace App\Http\Controllers;

use App\Models\ContactEnquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'company_name' => ['nullable', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        try {
            ContactEnquiry::create($data);
        } catch (\Throwable $exception) {
            Storage::disk('local')->append('contact-enquiries.log', json_encode($data, JSON_THROW_ON_ERROR));
        }

        $this->sendNotificationEmail($data);

        return back()->with('success', 'Thank you. Our team will be in touch shortly.')->withInput();
    }

    private function sendNotificationEmail(array $enquiryData): void
    {
        $admin = User::where('role', 'admin')->first();

        if (! $admin || empty($admin->notification_email)) {
            return;
        }

        try {
            $subject = $enquiryData['subject'] ?? 'New Enquiry';
            $mailSubject = "New Enquiry: {$subject} - from {$enquiryData['full_name']}";

            $body = "New enquiry received from the website contact form.\n\n";
            $body .= "Name: {$enquiryData['full_name']}\n";
            if (!empty($enquiryData['company_name'])) {
                $body .= "Company: {$enquiryData['company_name']}\n";
            }
            $body .= "Email: {$enquiryData['email']}\n";
            if (!empty($enquiryData['phone'])) {
                $body .= "Phone: {$enquiryData['phone']}\n";
            }
            $body .= "Subject: {$subject}\n\n";
            $body .= "Message:\n{$enquiryData['message']}\n\n";
            $body .= "---\nThis notification was sent from the Akyas website contact form.";

            Mail::raw($body, function ($message) use ($admin, $mailSubject, $enquiryData) {
                $message->to($admin->notification_email)
                    ->subject($mailSubject)
                    ->replyTo($enquiryData['email'], $enquiryData['full_name']);
            });
        } catch (\Throwable $exception) {
            \Log::error('Failed to send enquiry notification email: ' . $exception->getMessage());
        }
    }
}
