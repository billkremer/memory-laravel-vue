@extends('layout')

@section('content')
    <div class="container">


        <game-game></game-game>
        
    </div> {{--  container end --}}
<?php 

// Function to get the user IP address
function getUserIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = 'HTTP_CLIENT_IP'.$_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = 'HTTP_X_FORWARDED_FOR'.$_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = 'HTTP_X_FORWARDED'.$_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        $ipaddress = 'HTTP_X_CLUSTER_CLIENT_IP'.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = 'HTTP_FORWARDED_FOR'.$_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = 'HTTP_FORWARDED'.$_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = 'REMOTE_ADDR'.$_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}



print_r(getUserIP());

 print_r(getenv()); ?>
@endsection


