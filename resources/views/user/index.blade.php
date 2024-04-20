@include('layouts.header')
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'User', 'locations' => [['name' => 'User', 'route' => 'user.index', 'active' => false]]])
