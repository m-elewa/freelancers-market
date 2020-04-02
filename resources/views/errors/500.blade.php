@extends(config('setting.error_pages_layout'))

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
