function initMap()
{
    var lat = parseFloat($('#lat').val());
    var lang = parseFloat($('#lang').val());
    const map = new google.maps.Map(document.getElementById("map"),
    {
        center:
        {
            lat: lat,
            lng: lang
        },
        zoom: 13,
    });

    const card = document.getElementById("pac-card");
    const input = document.getElementById("pac-input");
    const autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.bindTo("bounds", map);

    autocomplete.setFields(["address_components", "geometry", "icon", "name"]);
    const infowindow = new google.maps.InfoWindow();
    const infowindowContent = document.getElementById("infowindow-content");
    infowindow.setContent(infowindowContent)    ;
    const marker = new google.maps.Marker({
        map,
        anchorPoint: new google.maps.Point(0, -29),
    });

    autocomplete.addListener("place_changed", () =>
    {
        infowindow.close();
        marker.setVisible(false);
        const place = autocomplete.getPlace();

        if (!place.geometry)
        {
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        $('#lat').val(place.geometry.location.lat().toFixed(5));
        $('#lang').val(place.geometry.location.lng().toFixed(5));
        if (place.geometry.viewport)
        {
            map.fitBounds(place.geometry.viewport);
        }
        else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        let address = "";

        infowindowContent.children["place-icon"].src = place.icon;
        infowindowContent.children["place-name"].textContent = place.name;
        infowindowContent.children["place-address"].textContent = address;
        infowindow.open(map, marker);
    });
}
