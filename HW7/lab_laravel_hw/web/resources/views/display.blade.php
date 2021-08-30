<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
        <nav class="navbar navbar-default navbar-fixed-top">					
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                @if (count($data) > 0)
                    <li><a href="clear">Clear all</a></li>
                @else
                    <li><a href="import">Import data</a></li>
                @endif
            </ul>				
        </nav><br><br><br><br>        
		<h2>HW7-Django Exercise</h2>
        <form action="search" method="GET" onsubmit="return check()">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-6 col-md-4">
                <div class="input-group">
                    <input type="number" min="1" class="form-control" placeholder="Search User" name="user_id"/>
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </form><br>

        <form action="recommend" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-6 col-md-4">
                <div class="input-group">
                    <input type="number" min="1"max="671" class="form-control" placeholder="Recommend movie" name="movie_id"/>
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <span class="glyphicon glyphicon-thumbs-up"></span>
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </form>      
        <br> 

        <div class="row">
            <form action="update" method="POST">
                {{ csrf_field() }}        
                <div class="col-xs-4"><input type="number" min="1" class="form-control" placeholder="User" name="user"/></div>
                <div class="col-xs-4"><input type="number" min="1" class="form-control" placeholder="Movie" name="movie"/></div>
                <div class="col-xs-4">
                    <div class="input-group">
                        <input type="number" step="0.5" min="0" max="5" class="form-control" placeholder="Edit Rating" name="rating"/>
                        <div class="input-group-btn">                        
                            <button class="btn btn-primary" type="submit">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>    
        </div>
        @if($errors->any())
        <br>
        <div class="alert alert-danger" role="alert">{{$errors->first()}}</div>
        @endif
        @if(session()->has('message'))
        <br>
        <div class="alert alert-success" role="alert">{{ session()->get('message') }}</div>
        @endif        
        
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>userId</th>
						<th>movieId</th>
						<th>rating</th>
                        <th></th>
					</tr>
				</thead>
				<tbody>
                    @foreach($data as $rating)
					<tr>
						<td>{{ $rating->userId }}</td>
						<td>{{ $rating->movieId }}</td>
						<td>{{ $rating->rating }}</td>
                        <td>
                            <form action="delete" method="POST">
                                {{ csrf_field() }}                            
                                <input type="hidden" name="deleteId" value="{{ $rating->id }}"/>                        
                                <button class="btn btn-link" style="outline:none" type="submit"><i class="glyphicon glyphicon-trash"></i></button>
                            </form>
                        </td>   
                    </tr>
                    @endforeach
				</tbody>
			</table>
		</div>
	</div>

</body>
<script>
    function check(){
        if(!$("input[name='user_id']").val()){
                alert('請填入user_id')
                return false
            }
        return true        
    }


</script>
</html>