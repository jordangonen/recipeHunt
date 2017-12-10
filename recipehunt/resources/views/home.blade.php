<head>
	<link rel="stylesheet" type="text/css" href="css/css.css"> <link
	rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	crossorigin="anonymous"> <link rel="stylesheet"
	href="css/font-awesome-4.7.0/css/font-awesome.min.css">

</head>

<body>
<!--layout extension-->
@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			@if(session('message'))
				<h4>{{session('message')}}</h4>
			@endif
<!--			create / submit your own recipe-->
        <button
			type="button"
			class="btn btn-block"
			data-toggle="modal"
			data-target="#createModal">
			Create Your Own Recipe
		</button>




			<br><br>
	@if(session('search'))
	<!-- {{ $cards = App\Recipe::where('name', session('search'))->get() }} -->
	@elseif(session('category'))
	<!-- {{ $cards = App\Recipe::where('choices', session('category'))->get() }} -->
	@else
	<!-- {{ $cards = App\Recipe::where('upvotes', '>=', '0')->orderBy('updated_at', 'desc')->get() }} -->
	@endif
    <!--<div class="d-inline-block text-center"><h1 class="d-inline-block">Home</h1></div>-->
<!--	send search-->
		@if(session('search'))
		<h4>Searching for recipes with name {{ session('search') }}</h4>
		@elseif(session('category'))
<!--	send category		-->
        <form action="/category" method="POST" class="form-group">
			{{ csrf_field() }}
            <label for="queryBy">Filter by</label>
                <select onchange="this.form.submit()" id="queryBy" name="category" default="{{ session('category') }}">
                     <option value="Recent">Recent</option>
                     <option value="Breakfast">Breakfast</option>
                     <option value="Snack">Snack</option>
                     <option value="Lunch">Lunch</option>
                     <option value="Dinner">Dinner</option>
                     <option value="Appetizer">Appetizer</option>
                     <option value="Dessert">Dessert</option>
                </select>
        </form>
		@else
<!--			send cateogry-->
		<form action="/category" method="POST" class="form-group">
			{{ csrf_field() }}
            <label for="queryBy">Filter by</label>
                <select onchange="this.form.submit()" id="queryBy" name="category" >
                     <option value="Recent">Recent</option>
                     <option value="Breakfast">Breakfast</option>
                     <option value="Snack">Snack</option>
                     <option value="Lunch">Lunch</option>
                     <option value="Dinner">Dinner</option>
                     <option value="Appetizer">Appetizer</option>
                     <option value="Dessert">Dessert</option>
                </select>
        </form>
<!--search -->
        <form action="/search" method="POST">
			{{ csrf_field() }}
            <label for ="searchBy">Search: </label>
            <input type="search" name="name" placeholder="Name of Recipe">
            <input type="submit" value="Go">
        </form>
		@endif
            <br><br>
<!--	pop up with create modal-->
		<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
			 <div class="modal-dialog" role="document">
			   <div class="modal-content">
				 <div class="modal-header">
				   <button type="button" class="close"
					 data-dismiss="modal"
					 aria-label="Close">
					 <span aria-hidden="true">&times;</span></button>
<!--modal for creating own recipe-->
				   <h4 class="modal-title" id="createModalLabel">Create Your Own Recipe</h4>
				 </div>
				 <div class="modal-body">

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
<!--					recipe form-->
				 <form action="/recipe" method="POST" enctype="multipart/form-data">
					 {{ csrf_field() }}
						<div class="form-group">
						  <label for="recipeTitle">Recipe Title</label>
						  <input type="text" class="form-control" name="name" id="recipeTitle" placeholder="Enter Name of Your Recipe">

						</div>
<!--							form group for selecting category-->
						<div class="form-group">
						  <label for="foodCategory">Type of Dish</label>
						  <select class="form-control" id="foodCategory" name="category" default="Breakfast">
							<option value="Breakfast">Breakfast</option>
							<option value="Snack">Snack</option>
							<option value="Lunch">Lunch</option>
							<option value="Dinner">Dinner</option>
							<option value="Appetizer">Appetizer</option>
							<option value="Dessert">Dessert</option>
						  </select>
						</div>

						<div class="form-group">
<!--					insert instructions-->
						  <label for="recipeInstructions">Recipe Instructions</label>
						  <textarea class="form-control" id="recipeInstructions" name="instructions" rows="8" placeholder="Write the instruction to your recipe here"></textarea>
						</div>
						<div class="form-group">
<!--						upload image-->
						  <label for="imageUpload">Upload an Image</label>
						  <input type="file" class="form-control-file" id="imageUpload" name="pic" aria-describedby="fileHelp">
						  <small id="fileHelp" class="form-text text-muted">High quality images with vibrant colors work best to show off your dish! </small>
						</div>
						<button type="submit" class="btn btn-primary">Submit Recipe</button>
					  </form>

				 </div>

				 <div class="modal-footer">
				   <button type="button" class="btn btn-default"
					  data-dismiss="modal">Close</button>
				</div>
			  </div>
			</div>
		  </div>
<!--			foreach to fill out the  cards -> pops up the view modal-->
		@foreach ($cards as $card)
    	<!--<div class="d-inline-block text-center"><h1 class="d-inline-block">Home</h1></div>-->
		<!-- {{$filepath = 'storage/recipe_images' . $card->filepath}} -->
		<div class="panel panel-default">
			<div class="panel-heading md-8">{{$card->name}}</div>
					<div class="card">
<!--					show image-->
						<img id="panel-image" class="d-inline-block pull-right " src="{{asset($filepath)}}"/>
						<h6 class="card-subtitle mb-2 text-muted">{{$card->choices}}</h6>
						<button
							type="button"
							class=""
							data-toggle="modal"
							data-target="#viewModal-{{$card->id}}">
							View/Comment
						</button><br><br>
						<form action="/bookmark/{{$card->id}}" method="POST">
							{{ csrf_field() }}
							<button type="submit" class="btn btn-link btn-xs">Bookmark</button>
						</form>
<!--UPVOTE!-->
						<div class="row-fluid">
							<form action="/upvote/{{$card->id}}" method="POST">
								{{ csrf_field() }}
								<div class="form-horizontal">
									<button type="submit" class="btn btn-link btn-xs">Upvote</button> <h6>{{$card->upvotes}}</h6>
								</div>
							</form>
						</div>
						<h6 class="card-subtitle mb-2 text-muted">Posted at: {{$card->updated_at}}</h6>
<!--VIEW MODAL-->
			<div class="modal fade" id="viewModal-{{$card->id}}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					 	<div class="modal-header">
					   		<button type="button" class="close"
						 		data-dismiss="modal"
						 		aria-label="Close">
						 		<span aria-hidden="true">&times;</span>
							</button>
					   		<h4 class="modal-title" id="viewModalLabel">{{$card->name}}</h4>
							<img id="recipe-image" class="center-block" src="{{asset($filepath)}}"/>
					 	</div>
					 	<div class="modal-body">
							<p>Category: {{$card->choices}}</p>
							<hr >
							<p><b>Instructions:</b></p>
							<p>
								{{$card->instructions}}
							</p>
							<p class="small">Posted: {{$card->updated_at}}</p>
							<hr>
							<!--<h3>Comments</h3>-->
	                        <div class="form-group">
								<form action="/comment" method="POST">
									{{ csrf_field() }}
									<label for="comment-content">Type a Comment</label>
		                            <input type="textarea" class="form-control" name="content">
		                            <input type="hidden" class="form-control" value="{{$card->id}}" name="story_id">
		                            <br>
		                            <input type="submit" class="btn btn-primary">
								</form>
	                        </div>
	                            <hr>
	                        <div class="comments">
	                            <h2>Comments</h2>
								<!-- {{ $comments = DB::table('comments')->where('recipe_id', $card->id)->get() }} -->
								<hr >
<!--								DISPLAY COMMENTS-->
								@foreach ($comments as $comment)
									<p>
										{{ DB::table('users')->where('id', $comment->user_id)->value('name') }} said: {{ $comment->comment }}
									</p>
									@if ($comment->user_id === Auth::id())
										<form action="/comment/{{$comment->id}}" method="POST">
											{{ method_field('PATCH') }}
											{{ csrf_field() }}
											<input type="textarea" name="content" class="form-control" value="{{$comment->comment}}">
											<br>
											<button type="submit" class="btn btn-xs block-inline">Edit Comment</button>
										</form>
<!--											DISPLAY DELETE-->
										<form action="/comment/{{$comment->id}}" method="POST">
											{{ method_field('DELETE') }}
											{{ csrf_field() }}
											<button type="submit" class="btn btn-xs btn-danger block-inline">DELETE</button>
										</form>
									@endif
									<hr >
								@endforeach
	                        </div>
					 	</div>
					 	<div class="modal-footer">
					   		<button type="button" class="btn btn-default" data-dismiss="modal">
						   		Close
					   		</button>
						</div>
				  	</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection
</body>
