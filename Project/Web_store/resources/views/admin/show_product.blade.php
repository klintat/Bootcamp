<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .center
        {
            margin: auto;
            width: 50%;
            border: 2px solid white;
            text-align: center;
            margin-top: 40px;
        }

        .font-size
        {
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }

        .img-size
        {
            width: 250px;
            height: 150px;
        }

        .th_color
        {
            background: grey;
        }

        .th_des
        {
            padding: 30px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <h2 class="font-size">All Products</h2>


                
            <table class="center">

                    <tr class="th_color">
                        <th class="th_des">Product title</th>
                        <th class="th_des">Description</th>
                        <th class="th_des">Quantity</th>
                        <th class="th_des">Catagory</th>
                        <th class="th_des">Price</th>
                        <th class="th_des">Product image</th>
                    </tr>

                    @foreach($product as $product)

                    <tr>
                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->catagory}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            <img class="img-size" src="/product/{{$product->image}}">
                        </td>
                    </tr>

                    @endforeach
                </tabel>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>