<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="static/css/styles.css">
    <title>Homeveg</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-light bg-navy">
        <div class="container">
            <ul class="nav nav-pills nav-white">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#signinmodal">SIGN IN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#signupmodal">SIGN UP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us | Call us 012-3847961</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- end of navbar -->
 @yield('content')


    <section class="footer bg-navy">
        <p class="text-center" style="margin-top: 30px;">&copy; 2019 Vegebox. All Rights Reserved</p>
    </section>

    <script>
        function myMap() {
          var map = new google.maps.Map(document.getElementById('map'), {
  center: {lat: 22.3038945, lng: 70.80215989999999},
  zoom: 13
});
var input = document.getElementById('searchMapInput');
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

var autocomplete = new google.maps.places.Autocomplete(input);
autocomplete.bindTo('bounds', map);

var infowindow = new google.maps.InfoWindow();
var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
});

autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();

    /* If the place has a geometry, then present it on a map. */
    if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
    } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);
    }
    marker.setIcon(({
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
        address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);

    /* Location details */
    document.getElementById('location-snap').innerHTML = place.formatted_address;
    document.getElementById('lat-span').innerHTML = place.geometry.location.lat();
    document.getElementById('lon-span').innerHTML = place.geometry.location.lng();
})
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_a2HlR9UW1hYskAIdUuaWcsUhJbNjkiY&callback=myMap"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>
