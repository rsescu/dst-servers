@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Hosts:</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <form action="/" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Server</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
    @foreach($hosts as $host)
                                        <tr>
                                            <td>{{ $host->name }}</td>
                                            <td>{{ $host->status }}</td>
    @if($host->on === true)
                                            <td><button type="submit" class="btn btn-secondary btn-block btn-success"
                                                formaction="hosts/{{ $host->name }}/stop">Stop Host</button></td>
    @elseif ($host->on === false)
                                            <td><button type="submit" class="btn btn-secondary btn-block btn-danger"
                                                formaction="hosts/{{ $host->name }}/start">Start Host</button></td>
    @else
                                            <td>{{ $host->on }}</td>
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
