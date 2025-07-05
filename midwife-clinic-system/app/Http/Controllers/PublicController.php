<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function home()
    {
        $services = Service::active()->take(6)->get();
        return view('public.home', compact('services'));
    }

    public function services()
    {
        $services = Service::active()->get();
        return view('public.services', compact('services'));
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Here you can send email or save to database
        // Mail::to('admin@clinic.com')->send(new ContactInquiry($request->all()));

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}