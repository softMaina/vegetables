@extends('layouts/app')

@section('content')
  <!-- landing page -->
  <div class="floating">
    <a href="https://wa.me/+254710345130" >
        <img src="/img/whatsapp.png" width="50px"/>
    </a>
  </div>
  <section class="landing">
      <div class="row overlay">
          <div class="container headlines">
              <h2 class="headline">Get Fresh Vegetables & Meat Boxes Delivered to Your Door Step Every Week
              </h2>
              <h3 class="subtitle">Free Delivery within Klang Valley</h3>
              <button class="btn btn-success order_button">Place an Order</button>
          </div>
      </div>
  </section>
  <!-- end of landing page -->

  <!-- steps section -->
  <section class="wrapper">
      <div class="card-wrapper">
          <div class="cards">
              <div class="cards-details">
                  <div class="head">
                      <h1>How Vegebox Work</h1>
                  </div>
                  <div class="options">
                      <div class="opt opt-1">
                          <div class="icon"><i class="fas fa-cloud-meatball"></i></div>
                          <div class="caption">
                              <p>Subscribe to our box</p>
                          </div>
                      </div>
                      <div class="opt opt-2">
                          <div class="icon"><i class="fas fa-hamburger"></i></div>
                          <div class="caption">
                              <p>We deliver to your doorstep</p>
                          </div>
                      </div>
                      <div class="opt opt-3">
                          <div class="icon"><i class="fas fa-utensils"></i></div>
                          <div class="caption">
                              <p>Cash on delivery</p>
                          </div>
                      </div>
                  </div>
                  <div class="foo">
                      <button class="btn btn-default order_button">Place an order</button>
                  </div>
              </div>
          </div>
      </div>

      </div>
  </section>
  <!-- end of steps section -->

  <section class="features"3>
      <div class="container">
          <div class="row">
            <div class="col-md-12">
                 <h3 class="text-center">Features</h3>
                 <p class="text-center">Loren ipsum</p>
             </div>
             <div class="col-md-4">
                 <img src="./static/img/icon1.png" alt="">
                 <h4>We buy at fresh market</h4>
                 <p>Write some description</p>
             </div>
             <div class="col-md-4">
                 <img src="./static/img/icon2.png" alt="">
                 <h4>Provide you actual bills</h4>
                 <p>Write some description</p>
             </div>
             <div class="col-md-4">
                 <img src="./static/img/icon3.png" alt="">
                 relative <h4>Our service fees <block>RM5</block>only</h4>
                 <p>Write some description</p>
             </div>
          </div>
      </div>
  </section>

  <section class="step-one">
      <div class="container">
          <div>
              <h2 class="text-center"><b>Step 1 -</b> Choose your subscription</h2>
              <p class="text-center">Lorem alot here</p>
          </div>
          <div class="row">
            @foreach ($products as $key => $value)
              <div class="col-md-4">
                  <div class="card shadow p-3 mb-5 bg-white" style="width: 20rem; margin:10; border-radius: 3%;">
                      <img class="card-img-top" src="./static/img/grocer.png" alt="Card image cap" id={{'img'.$value->id}}>
                      <div class="card-body">
                          <h5 class="card-title text-center theme_text" id={{'price'.$value->id}}>{{$value->price}}</h5>
                          <h3 class="card-title text-center" id={{'title'.$value->id}}>{{$value->title}}</h3>
                          <p class="card-text text-center">{{$value->description}}</p>
                          <div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="row">
                                          <div class="col-md-12 control-label">
                                              <label>Qty</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input class="form-control" id={{'qty'.$value->id}} placeholder="2" type="text"/>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="row form-group">
                                          <div class="col-md-12 control-label">
                                              <label>Time</label>
                                          </div>
                                          <div class="col-md-12">
                                              <input class="form-control" id={{'time'.$value->id}} type="text" placeholder="4:00 PM">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12 label-control">
                                      <label>Frequency</label>
                                  </div>
                                  <div class="col-md-12">
                                    <select id={{'frequency'.$value->id}} placeholder="select frequency" class="form-control">
                                        <option selected>One time delivery</option>
                                        <option value="EverySunday">Every Sunday</option>
                                        <option value="EverySaturday">Every Saturday</option>
                                        <option value="EveryMonday">Every Monday</option>
                                        <option value="EveryTuesday">Every Tuesday</option>
                                        <option value="EveryWednesday">Every Wednesday</option>
                                    </select>
                                  </div>
                              </div>
                          </div>
                          <button id={{$value->id}} class="btn btn-success addToCart" style="margin-top:0.8em" >Select And Proceed to next</button>
                      </div>
                  </div>
              </div>
            @endforeach
          </div>
      </div>
  </section>

  <section class="step-two">
      <div>
          <h2 class="text-center"><b class="theme_text">Step 2 -</b>Enter your delivery address</h2>
          <p class="text-center">Lorem alot here</p>
      </div>
      <div class="col-md-6" style="margin:auto;">
          <div class="card shadow">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-12" id="cartJS">
                    </div>
                    <div class="col-md-4">
                        <h4>My Cart</h4>
                        <div id="showMyCart"></div>
                    </div>
                    
                    <div class="col-md-8">
                        <form id="shippingData">
                          <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" id="shippingname"
                                    name="shippingname" placeholder="Name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" id="shippingmobile"
                                    name="shippingmobile" placeholder="Mobile" required>
                            </div>
                          </div>

                            <div class="form-group">
                                <input type="email" id="emailShipping" class="form-control" placeholder="Email" name="shippingemail" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="shippingremarks" id="shippingremarks" placeholder="Enter Remarks" required></textarea>
                           </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="shippingaddress" id="shippingaddress" placeholder="Enter location" required/>
                                <div id="map" style="width:100%;height:200px;"></div>                               
                           </div>
                           
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary order_button" id="checkout" onclick="return false;">Submit</button>
                        </form>


                    </div>
                  </div>
              </div>
          </div>
      </div>
       
  </section>
  @include('layouts.modals.signup')
  @include('layouts.modals.signin')
  @include('layouts.modals.loader')
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        let products = @json($products);
        $('#loadingDiv')
            .hide()  // Hide it initially
            .ajaxStart(function() {
                $(this).show();
            })
            .ajaxStop(function() {
                $(this).hide();
            });
        let urlAddToCart = "{{ url('/add-to-cart') }}";
        let urlCheckout = "{{ url('/checkout') }}";
        let urlRemoveFromCart = "{{ url('/remove-from-cart') }}";

        //ADD TO CART
        $('.addToCart').click(function(e){
            let idOfClickedItem = e.target.id;
            let orderItem = products.find((element) => element.id > idOfClickedItem);
            //console.log(idOfClickedItem);

            let selectedTime = $("#time"+idOfClickedItem).val();
            let selectedQuantity = $("#qty"+idOfClickedItem).val();
            let selectedFrequency = $("#frequency"+idOfClickedItem).val();
            let selectedImg = $("#img"+idOfClickedItem).attr('src');
            let selectedTitle = $("#title"+idOfClickedItem).text();
            let selectedPrice = $("#price"+idOfClickedItem).text();

            e.preventDefault();
            $.ajax({
                url: urlAddToCart,
                method: 'post',
                data: {
                    id: idOfClickedItem,
                    time: selectedTime,
                    qty: selectedQuantity,
                    frequency: selectedFrequency,
                    img: selectedImg,
                    title: selectedTitle,
                    price: selectedPrice,
                    "_token": $('#token').val()
                },
                success: function(result){
                    console.log(result)
                    showCart(result);
                    //$('#cartJS').text(JSON.parse(result));
                },
                failure: function(error){
                    console.log(error)
                }
            });
        });

        //CHECKOUT
        $('#checkout').click(function(e){
            if(validateShippingForm()){
                let shippingName = $("#shippingname").val();
                let shippingMobile = $("#shippingmobile").val();
                let shippingEmail = $("#shippingemail").val();
                let shippingRemarks = $("#shippingremarks").val();
                let shippingAddress = $("#shippingaddress").val();
                console.log(shippingName);
                console.log(shippingMobile);

                $("#loadingModal").modal("show");
                $.ajax({
                    url: urlCheckout,
                    method: 'post',
                    data: {
                        shippingName,
                        shippingMobile,
                        shippingEmail,
                        shippingRemarks,
                        shippingAddress,
                        "_token": $('#token').val()
                    },
                    success: function(result){
                        console.log(result);
                        $("#loadingModal").modal("hide");
                        window.location.replace(result);
                        //$('#cartJS').text(JSON.parse(result));
                    },
                    failure: function(error){
                        $("#loadingModal").modal("hide");
                        alert("Sorry, Something went wrong");
                        console.log(error)
                    }
                });
            }            
        }); 

        //REMOVE FROM CART
        $('body').on('click', '.removeFromCart', function(e){
            let idOfClickedItem = e.target.id;
            //alert("delete");
            e.preventDefault();
            $.ajax({
                url: urlRemoveFromCart,
                method: 'delete',
                data: {
                    "id": idOfClickedItem,
                    "_token": $('#token').val()
                },
                success: function(result){
                    console.log(result)
                    showCart(result);
                    //$('#cartJS').text(JSON.parse(result));
                },
                failure: function(error){
                    console.log(error)
                }
            });
        }); 
         

        //Cart Editor
        let showCart = (cart) => {
            $('#showMyCart').html("");
            cart.forEach(item => {
                let imgDiv = $("<img src='"+item.img+"' width='100px' />");
                let trashIcon = $("<i class='fas fa-trash float-right removeFromCart' id="+item.id+" style='cursor: pointer;'></i>");
                let timeDiv = $("<div><strong>Time:</strong>"+item.time+"</div>");
                let frequencyDiv = $("<div><strong>Frequency:</strong>"+item.frequency+"</div>");
                let qtyDiv = $("<div><strong>Quantity:</strong>"+item.qty+"</div>"); 
                let card = $("<div class='card'></div>");
                let cardBody = $("<div class='card-body'></div>");
                card.append(imgDiv);
                cardBody.append(trashIcon,timeDiv,frequencyDiv,qtyDiv);
                card.append(cardBody);
                $('#showMyCart').append(card);
            });
        }
        
        //validate shipping form
        let validateShippingForm = () => {

            var formValid = true;
            $('#shippingData input').each(function() {
                if ($(this).val() === '') {
                    formValid = false;
                }
            });

            if (!formValid)
                alert('One or Two fields in shipping info are empty. Please fill up all fields');
            return formValid;
        }     
    });

        

    function initialize() {
        // var options = {
        //     types: ['(cities)'],
        //     componentRestrictions: {country: "in"}
        // };
        var input = document.getElementById('city');
        var autocomplete = new google.maps.places.Autocomplete(input);
    }
    google.maps.event.addDomListener(window, 'load', initialize);

</script>
@endsection
