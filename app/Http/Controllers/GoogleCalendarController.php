<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class GoogleCalendarController extends Controller
{
    //

    public function index()
    {

////        Event::create([
////            'name' => 'A new event',
////            'startDateTime' => Carbon::now(),
////            'endDateTime' => Carbon::now()->addHour(),
////        ]);
       $events = Event::get();
//        $event


        return view('googleCalendar.calendar', compact('events'));
    }

    public function createEvents(Request $request)
    {
        $event = new Event();

        $event->name = 'A new event';
        $event->startDateTime = Carbon::now();
        $event->endDateTime = Carbon::now()->addHour();
        //$event->addAttendee(['email' => 'kirildemchenko23@gmail.com']);

        $event->save();

        return back();
    }



}
