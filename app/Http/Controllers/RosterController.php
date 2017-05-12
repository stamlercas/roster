<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use FantasyDataAPI;

class RosterController extends Controller
{
    protected $json_data = "data.json";
    protected $api_key = "dfd7f0e1d44540699051db7aff3324e2";


    function getRoster()
    {
        $data = json_decode(file_get_contents(storage_path() . "/app/json/" . $this->json_data));
        //return print_r($data);
        return json_encode($data);
    }

    function getFantasyDataTeams($year = '2016') {
        // Create a stream
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Ocp-Apim-Subscription-Key: $this->api_key\r\n"
            ]
        ];

        $context = stream_context_create($opts);

        // Open the file using the HTTP headers set above
        $file = json_decode(file_get_contents('https://api.fantasydata.net/v3/nfl/stats/JSON/TeamSeasonStats/' . $year, false, $context));

        return $file;
    }

    function getFantasyDataTeamData($team) {
    	// Create a stream
		$opts = [
		    "http" => [
		        "method" => "GET",
		        "header" => "Ocp-Apim-Subscription-Key: $this->api_key\r\n"
		    ]
		];

		$context = stream_context_create($opts);

		// Open the file using the HTTP headers set above
		$file = json_decode(file_get_contents('https://api.fantasydata.net/v3/nfl/stats/JSON/Players/' . $team, false, $context));

		return $file;
    }
}