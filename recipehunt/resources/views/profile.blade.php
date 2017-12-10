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
    <div class="panel panel-default">
    <div class="panel-heading">
        <div class="card">
            <div class="card-block">
<!--						PROFILE SETTINGS CARD-->
            <h4 class="card-title">Profile Settings</h4>
            <form action="/update/{{Auth::id()}}" method="POST" class="form-group">
<!--						SEND TOKEN-->
				{{ csrf_field() }}
            <br>
                <h2 class="text-center">
					{{ DB::table('users')->where('id', Auth::id())->value('name') }}
				</h2>
                <br><br>
<!--								FAVORITE FOOD FIELDS-->
                Favorite Food: &nbsp;<input type="text" placeholder="Bananas" name="food" value="{{ DB::table('users')->where('id', Auth::id())->value('favfood') }}"><br><br>
				Location: &nbsp;<input type="text" placeholder="Seattle" name="location" value="{{ DB::table('users')->where('id', Auth::id())->value('location') }}"><br><br>
				<button type="submit">Save Settings</button>
            </form>

            </div>
        </div>
    </div>
</div>
<!--	YOUR CREATED RECIPES PANEL-->
    <div class="panel panel-default">
    <div class="panel-heading">
        <div class="card">
            <div class="card-block">
            <h4 class="card-title">Your Created Recipes</h4>
            <ul>
<!--						GET ID-->
				<!-- {{ $cards = DB::table('recipes')->where('user_id', Auth::id())->get() }} -->
				@foreach ($cards as $card)
	              <li>{{ $card->name }} &nbsp &nbsp
	                <button
						type="button"
						class="pull-right"
						data-toggle="modal"
						data-target="#removeModal-{{$card->id}}">
						Remove
					</button>
						<button
						type="button"
						class="pull-right"
						data-toggle="modal"
						data-target="#editModal-{{$card->id}}">
						Edit
					</button>
							<button
						type="button"
						class="pull-right"
						data-toggle="modal"
						data-target="#viewRecipeModal-{{$card->id}}">
						View
					</button>


	               	</li>
					<hr>
<!--DELETE MODAL-->
					<div class="modal fade" id="removeModal-{{$card->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close"
										data-dismiss="modal"
										aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Remove {{$card->name}}?</h4>
								</div>
								<form action="/recipe/{{$card->id}}" method="POST">
<!--								ACTUAL DELETION-->
								<div class="modal-body">
										{{ method_field('DELETE') }}
										{{ csrf_field() }}
										Are you sure you want to delete this recipe?
							   </div>

								<div class="modal-footer">
								  <button type="submit" class="btn btn-default">DELETE RECIPE</button>
							   </div>
							   </form>
							 </div>
						   </div>
						 </div>
<!--							MODAL FOR EDITING RECIPE-->
				   	<div class="modal fade" id="editModal-{{$card->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close"
										data-dismiss="modal"
										aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">{{$card->name}}</h4>
								</div>
								<form action="/recipe/{{$card->id}}" method="POST">
									{{ method_field('PATCH') }}
									{{ csrf_field() }}
								<div class="modal-body">
									  	<div class="form-group">
											<label for="recipeTitle">Recipe Title</label>
											<input type="text" class="form-control" name="name" value="{{$card->name}}">
										</div>
										  	<div class="form-group">
												<label for="foodCategory">Type of Dish</label>
												<select class="form-control" name="category">
													<option value="Breakfast">Breakfast</option>
													<option value="Snack">Snack</option>
													<option value="Lunch">Lunch</option>
													<option value="Dinner">Dinner</option>
													<option value="Appetizer">Appetizer</option>
													<option value="Dessert">Dessert</option>
												</select>
										  	</div>

										<div class="form-group">
											<label for="recipeInstructions">Recipe Instructions</label>
											<textarea class="form-control" rows="8" name="instructions">{{$card->instructions}}</textarea>
										</div>

							   </div>

								<div class="modal-footer">
								  <button type="submit" class="btn btn-default">Save Changes</button>
							   </div>
							   </form>
							 </div>
						   </div>
						 </div>


<!--							view recipe modal-->
		<!-- {{$filepath = 'storage/recipe_images' . $card->filepath}} -->
<!--VIEW RECIPE MODAL-->
				<div class="modal fade" id="viewRecipeModal-{{$card->id}}" tabindex="-1" role="dialog" aria-labelledby="viewRecipeLabel">
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
							<hr>
							<p><b>Instructions:</b></p>
							<p>
								{{$card->instructions}}
							</p>
							<p class="small">Posted: {{$card->updated_at}}</p>
							<hr>
							<!--<h3>Comments</h3>-->
<!--DISPLAY COMMENTS IN MODAL-->

	                        <div class="comments">
	                            <h2>Comments</h2>
								<!-- {{ $comments = DB::table('comments')->where('recipe_id', $card->id)->get() }} -->
								<hr>
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
										<form action="/comment/{{$comment->id}}" method="POST">
											{{ method_field('DELETE') }}
											{{ csrf_field() }}
											<button type="submit" class="btn btn-xs btn-danger block-inline">DELETE</button>
										</form>
									@endif
									<hr>
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

				 @endforeach
            </ul>


            </div>
        </div>

    </div>
</div>
<!--BOOKMARKS PANEL-->
               <div class="panel panel-default">
    <div class="panel-heading">
        <div class="card">
            <div class="card-block">
            <h4 class="card-title">Your Bookmarked Recipes</h4>
			<!-- {{ $bookmarks = DB::table('recipes')->join('bookmarks', 'recipes.id', '=', 'bookmarks.recipe_id')->select('recipes.*')->where('bookmarks.user_id', Auth::id())->get() }} -->
<!--			VIEW BOOKMARKS-->
			@foreach ($bookmarks as $bookmark)
            <ul>
              <li>{{ $bookmark->name }}
                <button
					type="button"
					class="pull-right"
					data-toggle="modal"
					data-target="#viewRecipeModal-{{$bookmark->id}}">
					View
                </button>
                </li>

            </ul>
			@endforeach
            </div>
<!--							VIEW MODAL-->
            	<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel">
				 <div class="modal-dialog" role="document">
				   <div class="modal-content">
					 <div class="modal-header">
					   <button type="button" class="close"
						 data-dismiss="modal"
						 aria-label="Close">
						 <span aria-hidden="true">&times;</span></button>
					   <h4 class="modal-title" id="viewModalLabel">RECIPE TITLE</h4>
					 </div>
					 <div class="modal-body">
					   <p>Timestamp</p>
						<p>RECIPE CATEGORY</p>
						<p>RECIPE INSTRUCTIONS</p>
							<hr>
						<h2>Comments</h2>
					 </div>

					 <div class="modal-footer">
					   <button type="button" class="btn btn-default"
						  data-dismiss="modal">Close</button>
					</div>
				  </div>
				</div>
			  </div>
        </div>

    </div>

</div>



@endsection
</body>
