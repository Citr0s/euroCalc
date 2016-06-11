<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Euro 2016 Predictions</title>
  <link rel="stylesheet" href="/css/app.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
  <div class="container" style="margin-top:15px;">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">{{ $event->caption }}</h3>
      </div>
      <div class="panel-body">
        <div class="row" style="padding-bottom:15px;">
          <?php
            $date = Carbon\Carbon::create('2100');
          ?>
          @foreach($fixtures->fixtures as $key => $match)
            @if($date->gt(Carbon\Carbon::parse($match->date)) && $match->status !== 'FINISHED')
            <?php
              $date = Carbon\Carbon::parse($match->date);
              $match = $fixtures->fixtures[--$key];
            ?>
            <div class="col-md-4" style="text-align:left; color:#999;">
              <h4>
                Last match
              </h4>
              <p>Start: <strong>{{ Carbon\Carbon::parse($match->date)->toDateTimeString() }}</strong></p>
              <h3>{{ $match->homeTeamName }} <span style="font-weight:normal;">vs</span> {{ $match->awayTeamName }}</h3>
              <h3>{{ is_null($match->result->goalsHomeTeam) ? 0 : $match->result->goalsHomeTeam }} - {{ is_null($match->result->goalsAwayTeam) ? 0 : $match->result->goalsAwayTeam }}</h3>
            </div>
            <?php
              $date = Carbon\Carbon::parse($match->date);
              $match = $fixtures->fixtures[++$key];
            ?>
            <div class="col-md-4" style="text-align:center;">
              <h4>
                @if($match->status === 'IN_PLAY')
                  Playing
                @else
                  Scheduled
                @endif
              </h4>
              <p>Start: <strong>{{ Carbon\Carbon::parse($match->date)->diffForHumans() }}</strong></p>
              <h3>{{ $match->homeTeamName }} <span style="font-weight:normal;">vs</span> {{ $match->awayTeamName }}</h3>
              @if(Carbon\Carbon::parse($match->date)->lt(Carbon\Carbon::now()))
                <h3>{{ is_null($match->result->goalsHomeTeam) ? 0 : $match->result->goalsHomeTeam }} - {{ is_null($match->result->goalsAwayTeam) ? 0 : $match->result->goalsAwayTeam }}</h3>
              @endif
            </div>
            <?php
              $date = Carbon\Carbon::parse($match->date);
              $match = $fixtures->fixtures[++$key];
            ?>
            <div class="col-md-4" style="text-align:right; color:#999;">
              <h4>
                Next match
              </h4>
              <p>Start: <strong>{{ Carbon\Carbon::parse($match->date)->toDateTimeString() }}</strong></p>
              <h3>{{ $match->homeTeamName }} <span style="font-weight:normal;">vs</span> {{ $match->awayTeamName }}</h3>
              @if(Carbon\Carbon::parse($match->date)->lt(Carbon\Carbon::now()))
                <h3>{{ is_null($match->result->goalsHomeTeam) ? 0 : $match->result->goalsHomeTeam }} - {{ is_null($match->result->goalsAwayTeam) ? 0 : $match->result->goalsAwayTeam }}</h3>
              @endif
            </div>
            @endif
          @endforeach
        </div>
        <table class="table table-bordered">
        @foreach($table as $group)
            <tr style="background-color:#f3f3f3;">
              <td>Group {{ $group[0]->group }}</td><td>Games Played</td><td>Goals</td><td>Goals Against</td><td>Points</td>
            </tr>
          @foreach($group as $team)
            <tr>
              <td><img src="{{ $team->crestURI }}" style="width:20px; margin-right:5px; margin-bottom:2px;" />{{ $team->team }}</td><td>{{ $team->playedGames }}</td><td>{{ $team->goals }}</td><td>{{ $team->goalsAgainst }}</td><td>{{ $team->points }}</td>
            </tr>
          @endforeach
        @endforeach
        </table>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    setTimeout(function(){
      location.reload();
    }, 60000);
  </script>
</body>
</html>
