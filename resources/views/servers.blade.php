@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Owned Servers</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form action="/" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Server</th>
                                        <th>Game</th>
                                        <th>Hosted on</th>
                                    </tr>
                                    </thead>
                                    <tbody>
@foreach($owned_servers as $server)
                                        <tr>
                                            <td>{{ $server->name }}</td>
                                            <td>{{ $server->game }}</td>
                                            <td>{{ $server->host }}</td>
                                        </tr>
@endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="panel-heading">Admin to Servers</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Server</th>
                                            <th>Game</th>
                                            <th>Hosted on</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    @foreach($admined as $server)
                                        <tr>
                                            <td>{{ $server->name }}</td>
                                            <td>{{ $server->game }}</td>
                                            <td>{{ $server->host }}</td>
    @if($server->status == 2)
                                            <td><button type="submit" class="btn btn-secondary btn-block btn-success"
                                                        formaction="servers/{{ $server->id }}/stop">Stop Server</button></td>
    @elseif($server->status == 1)
                                            <td><button type="submit" class="btn btn-secondary btn-block btn-danger"
                                                        formaction="servers/{{ $server->id }}/start">Start Server</button></td>
    @else
                                            <td>Host Offline</td>
    @endif
                                        </tr>
    @endforeach
                                    </tbody>

                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
