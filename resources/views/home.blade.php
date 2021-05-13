@extends('layout')

@section('content')
    <div class="container">


        <game-game></game-game>
        
    </div> {{--  container end --}}
<?php 


        $ipaddress = '';
        if (!empty(getenv('HTTP_CLIENT_IP')))
            $ipaddress = 'HTTP_CLIENT_IP'.getenv('HTTP_CLIENT_IP');
        else if(empty(getenv('HTTP_X_FORWARDED_FOR')))
            $ipaddress = 'HTTP_X_FORWARDED_FOR'.getenv('HTTP_X_FORWARDED_FOR');
        else if(empty(getenv('HTTP_X_FORWARDED')))
            $ipaddress = 'HTTP_X_FORWARDED'.getenv('HTTP_X_FORWARDED');
        else if(empty(getenv('HTTP_X_CLUSTER_CLIENT_IP')))
            $ipaddress = 'HTTP_X_CLUSTER_CLIENT_IP'.getenv('HTTP_X_CLUSTER_CLIENT_IP');
        else if(empty(getenv('HTTP_FORWARDED_FOR')))
            $ipaddress = 'HTTP_FORWARDED_FOR'.getenv('HTTP_FORWARDED_FOR');
        else if(empty(getenv('HTTP_FORWARDED')))
            $ipaddress = 'HTTP_FORWARDED'.getenv('HTTP_FORWARDED');
        else if(empty(getenv('REMOTE_ADDR')))
            $ipaddress = 'REMOTE_ADDR'.getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';




print_r($ipaddress);

//  print_r(getenv()); ?>
@endsection


