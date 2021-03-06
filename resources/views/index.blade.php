@extends('layouts/app')

@section('content')
  <!-- landing page -->
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
                      <img class="card-img-top" src="./static/img/grocer.png" alt="Card image cap">
                      <div class="card-body">
                          <h5 class="card-title text-center theme_text">{{$value->price}}</h5>
                          <h3 class="card-title text-center">{{$value->title}}</h3>
                          <p class="card-text text-center">{{$value->description}}</p>
                          <div>



                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="row">
                                          <div class="col-md-3 control-label">
                                              <label>Qty</label>
                                          </div>
                                          <div class="col-md-9">
                                              <input class="form-control" id={{'qty'.$value->id}} placeholder="2" />
                                          </div>
                                      </div>

                                  </div>

                                  <div class="col-md-6">
                                      <div class="row form-group">
                                          <div class="col-md-2 control-label">
                                              <label>Time</label>
                                          </div>
                                          <div class="col-md-9">
                                              <select class="form-control" id={{ 'time'.$value->id }} style="margin-right: 0;">
                                                  <option selected>Time</option>
                                                  <option value="1">One</option>
                                                  <option value="2">Two</option>
                                                  <option value="3">Three</option>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-3 label-control">
                                      <label>Frequency</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" id={{'frequency'.$value->id}} placeholder="select frequency" />
                                  </div>
                              </div>
                          </div>
                          <button  id={{$value->id}} class="btn btn-primary order_button" >Select And Proceed to next</button>

                          <script type="text/javascript">
                          $(document).ready(function(){
                          var id = {!!$value->id!!}
                          var time = "time"+id
                          var qty = 'qty'+id
                          var frequency = 'frequency'+id
                          $('#'+id).click(function(e){
                             e.preventDefault();
                             $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                             $.ajax({
                                url: "{{ url('/add-to-cart') }}",
                                method: 'post',
                                data: {
                                   time: jQuery('#'+time).val(),
                                   qty: jQuery('#'+qty).val(),
                                   frequency: jQuery('#'+frequency).val()
                                },
                                success: function(result){
                                   console.log(result)
                                },
                                failure: function(error){
                                  console.log(error)
                                }
                              });
                             });
                          });
                          </script>
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
                    <div class="col-md-4">
                      @php
                        var_dump(Session::get('cart'));
                    @endphp
                    </div>
                    <div class="col-md-8">
                        <form >
                          <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control"
                                    name="name" placeholder="Name">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control"
                                    name="mobile" placeholder="Mobile">
                            </div>
                          </div>

                            <div class="form-group">
                                <input type="email" class="form-control"
                                    placeholder="Email">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="address" id="city" placeholder="Enter location"/>
                                <div id="map" style="width:100%;height:200px;"></div>
                                <script type="text/javascript">
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
                           </div>
                            <button type="submit" class="btn btn-primary order_button">Submit</button>
                        </form>


                    </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  @include('layouts.modals.signup')
  @include('layouts.modals.signin')
@endsection
