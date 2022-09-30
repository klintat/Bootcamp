<section class="product_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            @if(session()->has('message'))
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{session()->get('message')}}@endif
            </div>
            <div class="row">
               @foreach($product as $product)
               <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details', $product->id)}}" class="option1">
                           Product Details
                           </a>
                           <form action="{{url('add_cart', $product->id)}}" method="POST">
                              @csrf
                              <div class="row">
                                 <div class="col-md-4">
                                    <input type="number" name="quantity" value="1" min="1" style="width: 100px;">
                                 </div>
                                 <div class="col-md-4">   
                                    <input type="submit" value="Add to Cart" style="">
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/{{$product->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$product->title}}
                        </h5>
                        <h6 style="color: blue">
                           Price
                           <br>
                           ${{$product->price}}
                        </h6>
                     </div>
                  </div>
               </div>
               @endforeach
            <span style="padding-top: 20px;">
            </span>
   </div>
</section>