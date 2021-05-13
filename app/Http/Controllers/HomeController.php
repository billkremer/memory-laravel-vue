<?php

namespace App\Http\Controllers;

use App\Models\Score;
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

        $x = $this->getCookie($request, 'score');

        $y = getUserIP();



        

        return view('home', ['score' => $x, 'visitor' => $y]);

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

// $cookieName = 'XSRF-TOKEN';
        // return json_decode($request->cookie($cookieName));
        return $request->cookie($cookieName);
        // return $value;

    }

    /**
     * get the ip address for logging.
     *
     * @return String $ipaddress
     */

    private function getUserIP() {

        $ipaddress = '';
        if (!empty(getenv('HTTP_CLIENT_IP')))
            $ipaddress = 'HTTP_CLIENT_IP '.getenv('HTTP_CLIENT_IP');
        else if(!empty(getenv('HTTP_X_FORWARDED_FOR')))
            $ipaddress = 'HTTP_X_FORWARDED_FOR '.getenv('HTTP_X_FORWARDED_FOR');
        else if(!empty(getenv('HTTP_X_FORWARDED')))
            $ipaddress = 'HTTP_X_FORWARDED '.getenv('HTTP_X_FORWARDED');
        else if(!empty(getenv('HTTP_X_CLUSTER_CLIENT_IP')))
            $ipaddress = 'HTTP_X_CLUSTER_CLIENT_IP '.getenv('HTTP_X_CLUSTER_CLIENT_IP');
        else if(!empty(getenv('HTTP_FORWARDED_FOR')))
            $ipaddress = 'HTTP_FORWARDED_FOR '.getenv('HTTP_FORWARDED_FOR');
        else if(!empty(getenv('HTTP_FORWARDED')))
            $ipaddress = 'HTTP_FORWARDED '.getenv('HTTP_FORWARDED');
        else if(!empty(getenv('REMOTE_ADDR')))
            $ipaddress = 'REMOTE_ADDR '.getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;


    }





}
