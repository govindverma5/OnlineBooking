<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Book Store</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
    form {
  width: 100%;
  max-width: 500px;
  margin: 50px auto;
  background:#fafafa;
  -webkit-box-shadow: 0px 0px 96px 0px rgba(0,0,0,0.75);
  -moz-box-shadow: 0px 0px 96px 0px rgba(0,0,0,0.75);
  box-shadow: 0px 0px 96px 0px rgba(0,0,0,0.75);
  min-height: 250px;
  padding: 40px;
}

form input {
  width: 100%;
  height: 28px;
  margin-bottom: 15px;
  padding: 5px;
}
    </style>
    </head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card text-center">
                <h3 class="text-center m-2 mb-3 ">Books Detail Page</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h5>Title: {{$book->title ?? ''}}</h3>
                    <h5>Description: {{$book->description}}</h3>
                    <h5>Price: {{$book->price}}</h3>
                    @if (!empty($book) && !empty($book->category))
                    <h5>Category: {{$book->category->name}}</h3>
                    @else
                        <h5></h5>
                    @endif
                    @if (!empty($book) && !empty($book->author))
                    <h5>Author:
                        @foreach ($book->author as $auth)
                            {{ $auth->name ?? '' }}
                        @endforeach
                    </h5>
                    @else
                        <h5></h5>
                    @endif
                    <h5>Average Rating : {{$book->review->avg('rating') ?? '0'}}</h5>

                    <h3 class="mt-5"><B>Review Listing<b></h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Review</th>
                                <th scope="col">UserName</th>
                                <th scope="col">Book</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($book->review as $key => $review)
                                    <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $review->rating ?? '' }}</td>
                                    <td>{{ $review->review ?? '' }}</td>
                                    @if(!empty($review) && !empty($review->user))
                                    <td>{{$review->user->name ?? ''}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td>{{$review->book->title ?? ''}}</td>

                                </tr>
                            @endforeach
                        </tbody>
                        @if(Auth::user())
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            <h5><U>User Logged In</u></h5>
                            <button type="submit">Logout</button>
                        </form>
                        @endif
                    </table>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @elseif(Session::has('failed'))
                        <div class="alert alert-danger">
                            {{ Session::get('failed') }}
                        </div>
                    @endif
                    <form id="review" action="{{route('addReview')}}" method="POST">
                        @csrf
                        <h2>Add Review:</h2>
                         <input type="text" name="review" placeholder="review" required>
                         <input type="number" name="rating" placeholder="rating" max="5" required >
                         <input type="hidden" name="id" value="{{Crypt::encrypt($book->id)}}">
                         <button >Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
