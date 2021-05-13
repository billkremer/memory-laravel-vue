@extends('layout')

@section('content')
    <div class="container">


        <game-game></game-game>
        
    </div> {{--  container end --}}
<?php print_r(' x '.$_SERVER['REMOTE_ADDR']);
 print_r(' x '.$_SERVER['HTTP_X_FORWARDED_FOR']);
 print_r(' x '.$_SERVER['HTTP_CLIENT_IP']);
 print_r(' x '.getenv()); ?>
@endsection
