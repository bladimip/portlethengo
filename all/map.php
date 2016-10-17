<? top('Map') ?>

    <script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
    <script type="text/javascript">
        var map = null;

        function getMap()
        {
            map = new Microsoft.Maps.Map(document.getElementById('myMap'), {credentials: 'Your Bing Maps Key'});
        }
    </script>
    </head>
    <body onload="getMap();">
    <div id='myMap' style="position:relative; width:400px; height:400px;"></div>
    </body>


<? bottom() ?>