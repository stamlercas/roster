<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

        <script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>

    </head>
    <body>
        <div id="app">
            <header>
                <nav class="navbar navbar-default navbar-static-top" id="navbar">
                    <div class="container">
                      <div class="navbar-header">
                          <!--
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                          -->
                          <a class="navbar-brand header" href="#" @click="doubleTrouble()" :class="">Double Trouble</a>
                      </div>
                        <ul id='navbar-right' class="nav navbar-nav navbar-right">
                            <li><a>Filter</a></li>
                            <li><a>Sort</a></li>
                        </ul>
                        <div id="navbar" class="navbar-collapse collapse">
                        
                      </div><!--/.nav-collapse -->
                    </div>
                </nav>      
            </header>

            <div class="container main-content">
            <h1>Roster</h1>
            <table>
                <roster-item v-for="player in roster" :player="player"></roster-item>
            </table>
            </div>

        </div>

        <!-- templates -->
        <template id="roster-item">
          <tr>
            <td>@{{ player.JerseyNumber }}</td>
            <td>@{{ player.LastName }}, @{{ player.FootballName }}</td>
            <td>@{{ player.PositionAbbr }}</td>
            <td>@{{ player.Height }}</td>
            <td>@{{ player.Weight }}</td>
            <td>@{{ age }}</td>

          </tr>
      </template>
  </body>
</html>
