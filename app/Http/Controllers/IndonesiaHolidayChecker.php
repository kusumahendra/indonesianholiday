<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleCalendar;
use Carbon\Carbon;

class IndonesiaHolidayChecker extends Controller
{
    public function index()
    {
        return view('frontend.form.index');
    }
    public function check(GoogleCalendar $calendar, $date = FALSE)
    {
        try {
            $startDateTime= Carbon::createFromFormat('Y-m-d', $date)->startOfDay();
            $endDateTime= Carbon::createFromFormat('Y-m-d', $date)->endOfDay();
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => 'Invalid date format',
                'error'   => $e->getMessage(),
            ],400);
        }

        $calendarId = "en.indonesian#holiday@group.v.calendar.google.com";
        try {
            $results = $calendar->getEvent($calendarId, $startDateTime->toIso8601String(), $endDateTime->toIso8601String());
        }
        catch (\Exception $e) {
            return response()->json([
               'message' => 'Sorry, we had a Google API problem',
               'error'   => $e->getMessage(),
           ],200);
        }

        if (count($results->items)) {
            return response()->json([
                'date'          => $date,
                'day'           => $startDateTime->day,
                'month'         => $startDateTime->month,
                'year'          => $startDateTime->year,
                'date_formated' => $startDateTime->format('l, jS F Y'),
                'name'          => $results->items[0]->summary,
            ], 200);
        }
        else{
            return response()->json([
                'date'          => $date,
                'day'           => $startDateTime->day,
                'month'         => $startDateTime->month,
                'year'          => $startDateTime->year,
                'date_formated' => $startDateTime->format('l, jS F Y'),
                'name'          => null,
            ], 200);
        }
    }
}
