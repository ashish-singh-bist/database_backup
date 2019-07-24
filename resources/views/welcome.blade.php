<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Database Backup</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <style type="text/css">
            .main, .messages{
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container main">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="/backup_database" class="btn btn-info" onclick="this.innerHTML='Processing...'">Backup Database</a>
                </div>
            </div>
            <div class="row messages">
                 <div class="col-sm-12">
                    @if(session()->has('status_array'))
                        @foreach(session('status_array') as $alert)
                        <div class="alert @if(isset($alert['status'])) alert-{{$alert['status']}} @endif">
                            @if(isset($alert['msg']))
                            {!! $alert['msg'] !!}
                            @endif
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
