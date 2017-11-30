<?php namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class GoogleCalendar {

    protected $client;

    protected $service;

    function __construct() {
        /* Get config variables */
        $client_id = Config::get('google.client_id');
        $service_account_name = Config::get('google.service_account_name');
        $key_file_location = base_path() . Config::get('google.key_file_location');

        $this->client = new \Google_Client();
        $this->client->setApplicationName("indonesia_holidat");
        $this->service = new \Google_Service_Calendar($this->client);

        /* Check f we have an access token */
        if (Cache::has('service_token')) {
          $this->client->setAccessToken(Cache::get('service_token'));
        }

        $key = file_get_contents($key_file_location);
        /* Add the scopes */
        $scopes = array('https://www.googleapis.com/auth/calendar');
        $this->client->setAuthConfig($key_file_location);

        $this->client->setScopes($scopes);

        Cache::forever('service_token', $this->client->getAccessToken());
    }

    public function get($calendarId)
    {
        $results = $this->service->calendars->get($calendarId);
        dd($results);
    }
    public function getEvent($calendarId, $timeMin, $timeMax)
    {
        $optParams = array(
          'maxResults' => 10,
          'orderBy' => 'startTime',
          'singleEvents' => TRUE,
          'timeMin' => $timeMin,
          'timeMax' => $timeMax,
        );
        $results = $this->service->events->listEvents($calendarId, $optParams);
        return $results;
    }
}