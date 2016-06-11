<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    public function index(){
      $uri = 'http://api.football-data.org/v1/soccerseasons/424/';
      $reqPrefs['http']['method'] = 'GET';
      // $reqPrefs['http']['header'] = 'X-Auth-Token: TOKEN_GOES_HERE';
      $stream_context = stream_context_create($reqPrefs);

      $eventSource = file_get_contents($uri, false, $stream_context);
      $event = json_decode($eventSource);

      $fixtureSource = file_get_contents($event->_links->fixtures->href, false, $stream_context);
      $fixture = json_decode($fixtureSource);

      $tableSource = file_get_contents($event->_links->leagueTable->href, false, $stream_context);
      $table = json_decode($tableSource);

      return view('welcome')->with('event', $event)->with('table', $table->standings)->with('fixtures', $fixture);
    }
}
