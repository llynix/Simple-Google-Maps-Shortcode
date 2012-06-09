  function initialize(mlat,mlon,clat,clon,zoom,content,mtitle) {
    var myLatlng = new google.maps.LatLng(mlat,mlon);
    var centerLatlng = new google.maps.LatLng(clat,clon);
    var myOptions = {
      zoom: zoom,
      center: centerLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    var contentString = content;

    var infowindow = new google.maps.InfoWindow({
        disableAutoPan: true,
        content: contentString
    });

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: mtitle
    });
    infowindow.open(map,marker);
  }
