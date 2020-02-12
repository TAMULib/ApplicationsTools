setInterval(function () {
    var currentTime = new Date();
    var currentHours = currentTime.getHours();
    var currentMinutes = currentTime.getMinutes();
    var currentSeconds = currentTime.getSeconds();
            currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
            currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
    var timeOfDay = (currentHours < 12) ? "AM" : "PM";
            currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
            currentHours = (currentHours == 0) ? 12 : currentHours;
    var currentTimeString = currentHours + ":" + currentMinutes + " " + timeOfDay;
    document.getElementById("timer").innerHTML = currentTimeString;
}, 1000);



(function() {
        var idleDurationSecs = 300;
        var redirectUrl = '../sprints';  // Redirect idle users to this URL
        var idleTimeout;
      
        var resetIdleTimeout = function() {
          if(idleTimeout) clearTimeout(idleTimeout);
      
          idleTimeout = setTimeout(function(){
            location.href = redirectUrl
          }, idleDurationSecs * 1000);
        };
      
        resetIdleTimeout();
      
        ['click', 'touchstart', 'mousemove'].forEach(function(evt) {
          document.addEventListener(evt, resetIdleTimeout, false)
        });
      })();