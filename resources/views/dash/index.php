<!-- main title -->
@start('title')
{{ trans('dash.dashboard') }}
@end('title')

<!-- btn -->
@start('btn')
@end('btn')

<!-- content -->
@start('content')
@end('content')

<!-- main file -->
@extends('dash.layouts.main-1')


<!-- page title -->
@title('{{ trans("dash.dashboard") }}')
<!-- css link -->
@link('{{asset("test.css")}}')
<!-- js script -->
@script('{{asset("test.js")}}')