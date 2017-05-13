<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Pittsburgh Steelers Roster Project</title>

        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/logo.css') }}" rel="stylesheet" />
        <style>
          .logo {
            background: url("{{ asset('img/logos.png') }}") no-repeat;
            display: inline-block;
            /*padding: 4px 0 0 0; */
            border: 0;
            border-radius: 0;
            text-align: left;
            min-width: 20px;
            height: 16px;
            text-indent: 27px;
            text-align: left;
            vertical-align: middle;
            height: 20px;
          }
        </style>
        <script src="{{ URL::asset('js/app.js') }}"></script>

    </head>
    <body>
        <div id="app">
            <header>
                <nav class="navbar navbar-default navbar-static-top" id="navbar">
                    <div class="container">
                      <div class="navbar-form navbar-header">
                          <!--
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                          -->
                          <div class="dropdown form-group">
                              <button class="form-control btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                                <span class="logo" :class="teams[currentTeam].TeamName.toLowerCase()"></span>&nbsp; 
                                @{{ teams[currentTeam].TeamName }}
                                <span class="caret"></span>
                              </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" class="list-item" v-for="(team, index) in teams" @click="changeTeam(index)">
                                  <span>
                                    <span class="logo" :class="team.TeamName.toLowerCase()"></span>&nbsp; 
                                    @{{ team.TeamName }}
                                  </span>
                                </a>
                              </li>
                            </ul>
                          </div>
                      </div>
                      <div class="navbar-form nav navbar-nav navbar-right">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Search" v-model="search">
                        </div>
                      </div>
                      <!--
                        <ul id='navbar-right' class="nav navbar-nav navbar-right">
                            <li><a>Filter</a></li>
                            <li><a>Sort</a></li>
                        </ul>
                        -->
                        <div id="navbar" class="navbar-collapse collapse">
                        
                      </div><!--/.nav-collapse -->
                    </div>
                </nav>      
            </header>

            <div class="container main-content">
                <h1 v-if="!loading">Current Roster</h1>
                <div class="row" v-if="loading">
                  <div class="col-md-12">
                  <h1 v-if="loading">Loading @{{ teams[currentTeam].TeamName }} Roster...</h1>
                  <img class="loading img img-responsive" src="{{ asset('img/loading.gif') }}" alt="spinner" />
                  </div>
                </div>
                <roster :data="roster" :columns="columns" :filter-key="search" v-if="!loading"></roster>
            </div>
            <div class="modal fade" id="playerModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@{{ player.FirstName + " " + player.LastName }}</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-xs-6">
                        <h3>@{{ player.Position }}</h1>
                      </div>
                      <div class="col-xs-6">
                          <h3 class="text-right" v-if="player.Number != 0"><small>#</small>@{{ player.Number }}</h3>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <dl>
                              <dt>Height</dt>
                              <dd>@{{ player.Height }}</dd>
                              <dt>Weight</dt>
                              <dd>@{{ player.Weight }}</dd>
                              <dt>College</dt>
                              <dd>@{{ player.College }}</dd>
                              <dt>Experience</dt>
                              <dd>@{{ player.ExperienceString }}</dd>
                              <dt>Year Drafted</dt>
                              <dd>@{{ player.CollegeDraftYear }}</dd>
                              <dt v-if="player.CollegeDraftRound !== null">Draft Pick</dt>
                              <dd v-if="player.CollegeDraftRound !== null">Round @{{ player.CollegeDraftRound }} - Overall @{{ player.CollegeDraftPick }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-8">
                          <div class="clearfix">
                            <img class="img img-responsive pull-right" v-bind:src="player.PhotoUrl" />
                          </div>
                          <div v-for="news in player.LatestNews">
                            <h4><a v-bind:href="news.Url">@{{ news.Title }}</a> <small>@{{ news.Source }}</small></h4>
                            <article>
                              @{{ news.Content }}
                            </article>
                          </div>
                        </div>
                    </div>
                    <div v-if="player.PlayerSeason != null">@{{ player.PlayerSeason.Season }} Stats</div>
                    <div class="table-responsive">
                        <table class="table table-striped roster">
                            <thead>
                                <tr class="heading">
                                  <th v-for="stat in stats" :title="stat.StatString">@{{ stat.StatAbbr.toUpperCase() }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <!-- <tr v-for="player in roster"> -->
                                    <td v-for="stat in stats">@{{ stat.Stat }}</td>
                                </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>

        <!-- templates -->
        <script type="text/x-template" id="roster">
          <div class="table-responsive">
            <table class="table table-striped roster">
                <thead>
                    <tr class="heading">
                        <th @click="sortBy('Number')" :class="{ active: sortKey == 'Number' }"
                            title="#">#</th>
                        <th @click="sortBy('LastName')" :class="{ active: sortKey == 'LastName' }"
                            title="Last Name, First Name">Name</th>
                        <th @click="sortBy('Position')" :class="{ active: sortKey == 'Position' }"
                            title="Position">Position</th>
                        <th @click="sortBy('Height')" :class="{ active: sortKey == 'Height' }"
                            title="Height">Height</th>
                        <th @click="sortBy('Weight')" :class="{ active: sortKey == 'Weight' }"
                            title="Weight">Weight</th>
                        <th @click="sortBy('Age')" :class="{ active: sortKey == 'Age' }"
                            title="Birthdate">Age</th>
                        <th @click="sortBy('Experience')"  :class="{ active: sortKey == 'Experience' }" 
                            title="Years of Experience">Exp</th>
                        <th @click="sortBy('College')" :class="{ active: sortKey == 'College' }"
                            title="College">College</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="player in sortedRoster">
                    <!-- <tr v-for="player in roster"> -->
                        <td>@{{ player.Number | formatNumber }}</td>
                        <td @click="showPlayerModal(player)"><a class="name">@{{ player.LastName }}, @{{ player.FirstName }}</a></td>
                        <td>@{{ player.Position }}</td>
                        <td>@{{ player.Height }}</td>
                        <td>@{{ player.Weight }}</td>
                        <td>@{{ player.Age }}</td>
                        <td>@{{ player.Experience }}</td>
                        <td>@{{ player.College }}</td>
                    </tr>
              </tbody>
          </table>
        </div>
      </script>

      <!--
        <script type="text/x-template" id="modal-template">
          <transition name="modal">
            <div class="modal-mask">
              <div class="modal-wrapper">
                <div class="modal-container">

                  <div class="modal-header">
                    <slot name="header">
                      default header
                    </slot>
                  </div>

                  <div class="modal-body">
                    <slot name="body">
                      default body
                    </slot>
                  </div>

                  <div class="modal-footer">
                    <slot name="footer">
                      default footer
                      <button class="modal-default-button" @click="$emit('close')">
                        OK
                      </button>
                    </slot>
                  </div>
                </div>
              </div>
            </div>
          </transition>
        </script>
        -->
  </body>
</html>
