@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Owned Servers</div>

                    <div class="panel-body">
                        <ul>
@foreach($owned_servers as $server)
                            <li>{{ $server->name }}</li>
@endforeach
                        </ul>
                    </div>
                    <div class="panel-heading">Admin to Servers</div>

                    <div class="panel-body">
                        <ul>
@foreach($admined as $server)
                                <li>{{ $server->name }}</li>
@endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
