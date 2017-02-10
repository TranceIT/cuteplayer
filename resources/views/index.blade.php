<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <link type="text/css" href="./js/jPlayer-2.9.2/dist/skin/jplayer-skin-premium-pixels-master/assets/css/themicons.css" rel="stylesheet" media="all">
    <link type="text/css" href="./js/jPlayer-2.9.2/dist/skin/jplayer-skin-premium-pixels-master/assets/css/style.css" rel="stylesheet" media="all">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/jPlayer-2.9.2/dist/jplayer/jquery.jplayer.min.js"></script>
    <script type="text/javascript" src="./js/jPlayer-2.9.2/dist/add-on/jplayer.playlist.min.js"></script>
    <script type="text/javascript" src="./js/player.js"></script>
  </head>
  <body>
    <div id="page" class="demo">
      <div class="demo-player">
        <div id="jquery_jplayer_1" class="jp-jplayer"></div>
        <div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
          <div class="jp-interface">
            <div class="jp-button jp-playpause-button">
              <button class="jp-play" role="button" tabindex="0">play</button>
            </div>
            <div class="jp-time-rail">
              <div class="jp-progress">
                <div class="jp-seek-bar">
                  <div class="jp-play-bar"></div>
                </div>
              </div>
            </div>
            <div class="jp-button jp-volume-button">
              <button class="jp-mute" role="button" tabindex="0">max volume</button>
            </div>
            <div class="jp-volume-bar">
              <div class="jp-volume-bar-value"></div>
            </div>
          </div>
          <div class="jp-playlist">
            <ul>
              <li>&nbsp;</li>
            </ul>
          </div>
          <div class="jp-no-solution">
            <span>Update Required</span>
            To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
