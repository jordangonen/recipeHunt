<head>
	<link rel="stylesheet" type="text/css" href="css/css.css"> <link
	rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	crossorigin="anonymous"> <link rel="stylesheet"
	href="css/font-awesome-4.7.0/css/font-awesome.min.css">

</head>

<body>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <button
        			type="button"
        			class="btn btn-block"
        			data-toggle="modal"
        			data-target="#createModal">
        			Create A Posting
        		</button><br><br>
                <!-- {{ $jobs = DB::table('jobs')->join('users', 'jobs.user_id', '=', 'users.id')->select('jobs.*', 'users.name')->get() }} -->
                @foreach($jobs as $job)
                <div class="panel panel-default">
                    <div class="panel-heading md-8">
                        Job Request from {{ $job->name }}
                    </div>
                    <div class="card">
                        <h5 class="text-center">Description: {{$job->job}}</h5>
                        <h6>Location: {{$job->loc}}</h6>
                    </div>
                </div>
                @endforeach
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-laberl="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="createModalLabel">Create Your Own Job Request</h4>
                            </div>
                            <div class="modal-body">
                                <form action="/jobrequest" method="POST">
                                    {{ csrf_field() }}
                                    Job: <input type="textarea" class="form-control" name="job" placeholder="Job Name">
                                    Location: <input type="textarea" class="form-control" name="loc" placeholder="e.g. Seattle">
                                    <br>
                                    <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
</body>
