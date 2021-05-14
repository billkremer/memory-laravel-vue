<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $scores = $this->getCookie($request, 'score');

        $visitor = new Visitor();
        $ip = $this->getUserIP();
        $visitor->ipfrom = $ip['ipfrom'];
        $visitor->ipaddress = $ip['ipaddress'];
        $visitor->save();
        

        return view('home', ['score' => $scores, ]);

    }

    /**
     * Display a listing of the resource without logging.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMe(Request $request)
    {
        $scores = $this->getCookie($request, 'score');

        return view('home', ['score' => $scores, ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $value = json_encode($request->input('data'));
        $minutes = 60 * 24 * 365; // 1 year

        return cookie()->queue('score', $value, $minutes);

        // $this->setCookie($value, 'score');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Score $score)
    {
        return $request->cookie('score');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }

    /**
     * set the cookie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function setCookie($value, $cookieName, $minutes = 60 * 24 * 365) {

        // $minutes = 60 * 24 * 365; // 1 year
        cookie()->queue($cookieName, $value, $minutes);


        // $value = json_encode($request->input('data'));
        // $response = new Response('set my cookie');
        // $response->withCookie(cookie($cookieName, $value, $minutes ));

        // cookie($cookieName, $value, $minutes );

        // Cookie::queue($cookieName, $value, $minutes);

    }

    /**
     * get the cookie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function getCookie(Request $request, $cookieName) {

        return $request->cookie($cookieName);

    }

    /**
     * get the ip address for logging.
     *
     * @return String $ipaddress
     */

    private function getUserIP() {

        $ipinfo = '';
        if (!empty(getenv('HTTP_CLIENT_IP')))
            $ipinfo = ['ipfrom' => 'HTTP_CLIENT_IP ', 'ipaddress' => getenv('HTTP_CLIENT_IP')];
        else if(!empty(getenv('HTTP_X_FORWARDED_FOR')))
            $ipinfo = ['ipfrom' => 'HTTP_X_FORWARDED_FOR ', 'ipaddress' => getenv('HTTP_X_FORWARDED_FOR')];
        else if(!empty(getenv('HTTP_X_FORWARDED')))
            $ipinfo = ['ipfrom' => 'HTTP_X_FORWARDED ', 'ipaddress' => getenv('HTTP_X_FORWARDED')];
        else if(!empty(getenv('HTTP_X_CLUSTER_CLIENT_IP')))
            $ipinfo = ['ipfrom' => 'HTTP_X_CLUSTER_CLIENT_IP ', 'ipaddress' => getenv('HTTP_X_CLUSTER_CLIENT_IP')];
        else if(!empty(getenv('HTTP_FORWARDED_FOR')))
            $ipinfo = ['ipfrom' => 'HTTP_FORWARDED_FOR ', 'ipaddress' => getenv('HTTP_FORWARDED_FOR')];
        else if(!empty(getenv('HTTP_FORWARDED')))
            $ipinfo = ['ipfrom' => 'HTTP_FORWARDED ', 'ipaddress' => getenv('HTTP_FORWARDED')];
        else if(!empty(getenv('REMOTE_ADDR')))
            $ipinfo = ['ipfrom' => 'REMOTE_ADDR ', 'ipaddress' => getenv('REMOTE_ADDR')];
        else
            $ipinfo = ['ipfrom' => 'UNKNOWN', 'ipaddress' => 'UNKNOWN'];
        return $ipinfo;


    }





}
