<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <title>Jobthai 2.0 Happytime Report</title>
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Jobthai 2.0 Happytime Report</h1>
            <hr>

            <div class="row">
                <form class="form-inline" action="/">
                    {{-- <div class="form-group col-xs-offset-2 col-xs-1">
                        <select name="sprint">
                            @foreach (App\Sprint::all() as $value)
                                <option value="{{ $value->sprint }}" {!! $value->sprint == $sprint ? 'selected' : '' !!}>Sprint {{ $value->sprint }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group col-xs-offset-3 col-xs-3">
                        <label>Start Date : </label>
                        <input type="date" name="startdate" value="{{ $startdate }}">
                    </div>
                    <div class="form-group col-xs-3">
                        <label>End Date : </label>
                        <input type="date" name="enddate" value="{{ $enddate }}">
                    </div>
                    <div class="col-xs-1">
                        <input class="btn btn-xs btn-info" type="submit" value="Submit">
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-xs-offset-2 col-xs-8">
                    <hr>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>name</th>
                                <th class="text-center">Happy Point</th>
                            </tr>
                        </thead>
                        @foreach ($stat as $key => $value)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td>{{ $value->user_name }}</td>
                                <td class="text-center">{!! trans('happytime.' . $value->text) !!}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-offset-8 col-xs-2">
                    <table class="table table-bordered">
                        <tr>
                            <td>{!! trans('happytime.1') !!}</td>
                            <td class="text-right">{!! $stat->where('text', '1')->count() !!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('happytime.2') !!}</td>
                            <td class="text-right">{!! $stat->where('text', '2')->count() !!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('happytime.3') !!}</td>
                            <td class="text-right">{!! $stat->where('text', '3')->count() !!}</td>
                        </tr>
                        <tr class="info">
                            <td>เฉลี่ย</td>
                            <td class="text-right">{{ $stat->avg('text') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>