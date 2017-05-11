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
                          <a class="navbar-brand header" href="#">@{{ team.Club_Name }}</a>
                      </div>
                      <form class="navbar-form navbar-right">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Search" v-model="search">
                        </div>
                      </form>
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
                <h1 @click="console.log(player)">@{{ team.Season }} Roster</h1>
                <roster :data="roster" :columns="columns" :filter-key="search"></roster>
            </div>
            <div class="modal fade" id="playerModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@{{ player }}</h4>
                  </div>
                  <div class="modal-body">
                    <p>One fine body&hellip;</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>

        <!-- templates -->
        <script type="text/x-template" id="roster">
            <table class="table table-striped roster">
                <thead>
                    <tr class="heading">
                        <th @click="sortBy('JerseyNumber')" :class="{ active: sortKey == 'JerseyNumber' }"
                            title="#">#</th>
                        <th @click="sortBy('LastName')" :class="{ active: sortKey == 'LastName' }"
                            title="Last Name, First Name">Name</th>
                        <th @click="sortBy('PositionAbbr')" :class="{ active: sortKey == 'PositionAbbr' }"
                            title="Position">Position</th>
                        <th @click="sortBy('Height')" :class="{ active: sortKey == 'Height' }"
                            title="Height">Height</th>
                        <th @click="sortBy('Weight')" :class="{ active: sortKey == 'Weight' }"
                            title="Weight">Weight</th>
                        <th @click="sortBy('Birthdate')" :class="{ active: sortKey == 'Birthdate' }"
                            title="Birthdate">Age</th>
                        <th @click="sortBy('NFLExperience')"  :class="{ active: sortKey == 'NFLExperience' }" 
                            title="Years of Experience">Exp</th>
                        <th @click="sortBy('College')" :class="{ active: sortKey == 'College' }"
                            title="College">College</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="player in sortedRoster">
                    <!-- <tr v-for="player in roster"> -->
                        <td>@{{ player.JerseyNumber }}</td>
                        <td @click="showPlayerModal(player)">@{{ player.LastName }}, @{{ player.FootballName }}</td>
                        <td>@{{ player.PositionAbbr }}</td>
                        <td>@{{ player.Height }}</td>
                        <td>@{{ player.Weight }}</td>
                        <td>@{{ player.Birthdate | getAge }}</td>
                        <td>@{{ player.NFLExperience }}</td>
                        <td>@{{ player.College }}</td>
                    </tr>
              </tbody>
          </table>
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
