
var base_url = $('#mainurl').val();
var marker = [];
$(document).ready(function ()
{
  $.ajax(
    {
      headers:
      {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "GET",
      url: base_url + '/admin/vectormap',
      success: function (result) 
      {
          for (let i = 0; i < result.data.length; i++) 
          {
              // custimization.push(
                  //     {
                      //         'main_menu' : $('input[type=checkbox][id=chkbox'+i+']:checked').val(),
                      //         'data' : {
                          //             'name' : name,
                          //             'price' : price,
            //         }
            //     });
            marker.push(
            {
                latLng : [result.data[i].lat,result.data[i].lang], 
                name : result.data[i].name,
                // style : { 'fill': '#6777ef' } 
            },);
            }
        vector_map();
      },
      error: function (err) {
        console.log('err ', err)
      }
    });
});

function vector_map() 
{
  $('.vector_map').vectorMap(
  {
    map: 'world_mill_en',
    backgroundColor: '#95bfea',
    borderColor: '#000000',
    borderOpacity: .8,
    borderWidth: 1,
    hoverColor: '#000',
    hoverOpacity: .8,
    hover: false,
    color: '#000000',
    normalizeFunction: 'linear',
    selectedRegions: false,
    showTooltip: false,
    markers: marker,
    pins:
    {
      id: '<div class="jqvmap-circle"></div>',
      my: '<div class="jqvmap-circle"></div>',
      th: '<div class="jqvmap-circle"></div>',
      sy: '<div class="jqvmap-circle"></div>',
      eg: '<div class="jqvmap-circle"></div>',
      ae: '<div class="jqvmap-circle"></div>',
      nz: '<div class="jqvmap-circle"></div>',
      tl: '<div class="jqvmap-circle"></div>',
      ng: '<div class="jqvmap-circle"></div>',
      si: '<div class="jqvmap-circle"></div>',
      pa: '<div class="jqvmap-circle"></div>',
      au: '<div class="jqvmap-circle"></div>',
      ca: '<div class="jqvmap-circle"></div>',
      tr: '<div class="jqvmap-circle"></div>',
    },
  
    markersSelectable: true,
    hoverOpacity: 0.7,
    markersSelectable: true,
    markerStyle: {
      initial: 
      {
        fill: 'grey',
        stroke: '#505050',
        "fill-opacity": 1,
        "stroke-width": 1,
        "stroke-opacity": 1,
        r: 5
      },
      hover: 
      {
        stroke: 'black',
        "stroke-width": 2,
        title : 'Map'
      },
      selectedHover: {
      }
    },
  });
}