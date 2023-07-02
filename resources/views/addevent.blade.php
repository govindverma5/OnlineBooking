<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>event management</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h3 class="text-center">Event Management System</h3>
                        
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        <div class="card-body">
                            <form action="{{route('eventsadded')}}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <label for="exampleFormControlInput1" class="form-label">Event Name</label>
                                        <input type="text" name="name" class="form-control" id="eventname" placeholder="Event Name">
                                    </div>
                                    <div class="col-6">
                                        <label for="exampleFormControlTextarea1" class="form-label">Event Description</label>
                                        <textarea name="description" class="form-control" id="eventdescription" placeholder="Event Description" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="exampleFormControlTextarea1" class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" id="startdate" placeholder="start date">
                                    </div>
                                    <div class="col-6">
                                        <label for="exampleFormControlTextarea1" class="form-label">End Date</label>
                                        <input type="date" name="end_date" class="form-control" id="enddate" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="exampleFormControlInput1" class="form-label">Organizer</label>
                                        <input type="text" name="organizer" class="form-control" id="organizer" placeholder="organizer">
                                    </div>
                                    <div class="col-6">
                                        <label for="exampleFormControlInput1" class="form-label">Add New Ticket</label>
                                        <a type="submit" onclick="testMe()" class="btn btn-primary form-control">Add New Ticket</a>
                                    </div>
                                </div>
                          

                        <br> <br>
                            <div class="table-responsive" id="table" >
                                <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">id</th>
                                                <th scope="col">Ticket No</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Actions</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <div class="row" id="dataajax">
                                            <div class="col-3">
                                                <label for="exampleFormControlInput1" class="form-label">Ticket No</label>
                                                <input type="text"   name="ticketno" class="form-control" id="ticketno" placeholder="Ticketno">
                                            </div>
                                            @error('ticketno')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="col-3">
                                                <label for="exampleFormControlInput1" class="form-label">price</label>
                                                <input type="text"   name="price" class="form-control" id="price" placeholder="price">
                                            </div>
                                            @error('price')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="col-3">
                                                <label for="exampleFormControlInput1" class="form-label">Save</label>
                                                <a type="button" id="button" class="btn btn-primary form-control" >Save</a>
                                            </div>
                                        </div>
                                        </form>
                                      
                                        @foreach($data as  $data)
                                            <tr>
                                                <tr>
                                                    <td>{{$data->id}} </td>
                                                    <td>{{$data->ticket_no}}</td>                                                                        
                                                    <td>{{$data->price}}</td>
                                                    <td>
                                                        <!-- <a  data-id="{{$data->id}}" data-toggle="modal" data-target="#exampleModal{{$data->id}}" class="btn btn-primary">
                                                            <i class="fa fa-edit"></i>Edit
                                                        </a> -->
                                                        
                                                        <a href="{{ route('ticketdelete', ['id'=>$data->id]) }}" class="btn btn-primary ">
                                                            <i class="fa fa-delete"></i>Delete
                                                        </a>
                                                    </ul>
                                                    </td>
                                                </tr> 
                                            </tr>
                                            
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Ticket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modalupdate">
      <div class="modal-body" >
        <div class="col-3">
            <input type="hidden" name="id" id="id">
            <label for="exampleFormControlInput1" class="form-label">Ticket No</label>
            <input type="text"   name="ticketno" class="form-control" value="{{$data->ticket_no}}" id="ticketno" placeholder="Ticketno">
        </div>
            <div class="col-3">
                <label for="exampleFormControlInput1" class="form-label">price</label>
                <input type="text"   name="price" class="form-control"  value="{{$data->price}}"  id="price" placeholder="price">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a type="button" id="butt" class="btn btn-primary" >Save</a>
      </div>
      </div>
    </div>
  </div>
</div>
                                        @endforeach 
                                        </tbody>
                                </table>
                                <button type="submit"  method="post" class="btn btn-primary form-control">Save Event</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
           
           
              
    $('#dataajax').on('click', '#button',function(){
      var price = $('#price').val();
      var ticketno = $('#ticketno').val();
    

      if(price!="" && ticketno!=""){
        /*  $("#butsave").attr("disabled", "disabled"); */
          $.ajax({
              url: "/save-data",
              type: "POST",
              data: {
                  _token: "{{ csrf_token() }}",
                  price: price,
                  ticketno: ticketno
              },
              cache: false,
              success: function(dataResult){
                  location.reload();
                  console.log(dataResult);
                  var dataResult = JSON.parse(dataResult);
                  if(dataResult.statusCode==200){
                    window.location = "/save-data";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  } 
              }
          })
      }
      else{
          alert('Please Ticket number and price !');
      }
  })


     //update ajax      
  $('#modalupdate').on('click', '#butt',function(){
      var price = $('#price').val();
      var ticketno = $('#ticketno').val();
      var id = $('#id').val();
      
        /*  $("#butsave").attr("disabled", "disabled"); */
          $.ajax({
              url: "ticket-update/{id}",
              type: "POST",
              data: {
                  _token: "{{ csrf_token() }}",
                  price: price,
                  ticketno: ticketno
              },
              cache: false,
              success: function(dataResult){
                  location.reload();
                  console.log(dataResult);
                  var dataResult = JSON.parse(dataResult);
                  if(dataResult.statusCode==200){
                    window.location = "/update-ticket";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  } 
              }
          })
      
   
  })


            function testMe() {
                var x = document.getElementById("table");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
</body>
</html>

