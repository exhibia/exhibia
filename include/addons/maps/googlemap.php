
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <div class="clear"></div>
    <script type="text/javascript">
        var map;
        var currentMarker,lastMarker;
        $(function(){
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var myOptions = {
                zoom: 5,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

            $('#map-show').click(function(){
                $('#map_canvas').slideDown("normal");
            });

            $('#map-hide').click(function(){
                $('#map_canvas').slideUp("normal");
            });
        });

        function updateMarker(currentPos,currentName,lastPos,lastName){
            if(lastMarker){
                lastMarker.setMap(null);
            }

            if(lastPos){
                var lastposs=lastPos.split(',');

                if(lastposs.length==2){
                    var lastLatlng=new google.maps.LatLng(lastposs[0],lastposs[1]);

                    var oldimage = 'img/map-flag-old.png';
                    lastMarker = new google.maps.Marker({
                        position: lastLatlng,
                        map: map,
                        icon: oldimage,
                        title:lastName
                    });
                    map.setCenter(lastLatlng);
                }

            }

            if(currentMarker){
                currentMarker.setMap(null);
            }

            currentPoss=currentPos.split(',');
            if(currentPoss.length==2){
                var curLatlng=new google.maps.LatLng(currentPoss[0],currentPoss[1]);
                var newimage = 'img/map-flag-new.png';
                currentMarker = new google.maps.Marker({
                    position: curLatlng,
                    map: map,
                    icon: newimage,
                    title:currentName
                });
                map.setCenter(curLatlng);
            }


        }
    </script>
    <div id="map_container">
        <div id="map-title">
            <input id="map-show" value="<?php echo SHOW; ?>" type="button"/>
            <input id="map-hide" value="<?php echo HIDE?>" type="button"/>
        </div>
        <div id="map_canvas" class="rounded_corner" style="height:200px"></div>
    </div>
    <div class="clear"></div>
