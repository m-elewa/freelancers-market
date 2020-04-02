@extends(config('setting.error_pages_layout'))

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))

{{-- @section('image')
<img src="https://camo.githubusercontent.com/f37367f31e871c7dce5567a224b1991e312fdf82/68747470733a2f2f7261772e6769746875622e636f6d2f7068696c6970626a6f7267652f4f6f70732d72622f6d61737465722f6c6f676f2e706e67"></img>
@endsection --}}
