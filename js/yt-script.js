function youTubes_makeDynamic() {
      var $ytIframes = $('iframe[src*="youtube"]');
      $ytIframes.each(function (i,e) {
        $ytIframes.wrap("<div class='ytVideo'/>");

        var $ytFrame = $(e);
        var ytKey;
        var tmp = $ytFrame.attr('src').split(/\//); 
        tmp = tmp[tmp.length - 1]; 
        tmp = tmp.split('?');
        ytKey = tmp[0];

        var $ytLoader = $('<div class="ytLoader" style="background: url(https://i.ytimg.com/vi/'+ytKey+'/hqdefault.jpg) center no-repeat;"><div class="playBtn">');
        $ytLoader.data('$ytFrame',$ytFrame);
        $ytFrame.replaceWith($ytLoader);

        $ytLoader.click(function () {
          var $ytFrame = $ytLoader.data('$ytFrame');
          var videoURL = $ytFrame.attr('src');
          videoURL = videoURL.split('?')[0];
          $ytFrame.attr('src',videoURL+'?autoplay=1&showinfo=0&rel=0');
          $ytLoader.replaceWith($ytFrame);
        });
      });
};
$(document).ready(function () {youTubes_makeDynamic()});