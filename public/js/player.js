$(document).ready(function(){

    playlist = new jPlayerPlaylist({
        jPlayer: '#jquery_jplayer_1',
        cssSelectorAncestor: '#jp_container_1'
    }, [{
          title: 'Cro Magnon Man',
          mp3: 'http://player.lan/getTrack',
    }], {
        swfPath: 'assets/js/vendor',
        supplied: 'mp3',
        wmode: 'window',
        useStateClassSkin: true,
        autoBlur: false,
        keyEnabled: true
    });

    $(".jp-show-playlist").click(function(){
        $(".jp-playlist").slideToggle();
    });

});
