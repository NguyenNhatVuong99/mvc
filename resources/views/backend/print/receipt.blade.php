<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    
    <div class="container mt-5 mb-5">
    <div class="row receipt d-flex justify-content-center">
        <div class="card " style="width:50%">
          <div class="card-header text-center">
            @php 
            $category=DB::table('category_receipts')->where('id',$receipt->cat_id)->first();
            @endphp
            
            <h3 id="name">{{ $category->name }}</h3>
            <p>{{ $receipt->date }}</p>
          </div>
          <div class="card-body">
            @php 
            $category=DB::table('category_receipts')->where('id',$receipt->child_cat_id)->first();
            @endphp
            <ul class="list-group">
              
              <li class="list-group-item">Số tiền: @php
                echo number_format($receipt->total);
            @endphp vnđ
          </li>
              <li class="list-group-item">Loại: {{ $category->name }}</li>
              <li class="list-group-item">Ghi chú: {{ $receipt->note }}</li>
            </ul>
          </div>
        </div>
      </div>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  <script>
    window.print();
    
  </script>
</html>
