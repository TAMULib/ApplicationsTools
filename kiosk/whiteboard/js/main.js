const staticColumns = [
  document.getElementById("pending"),
  document.getElementById("at-large"),
  document.getElementById("ongoing"),
  document.getElementById("on-prod"),
  document.getElementById("moving-prod"),
  document.getElementById("on-pre"),
  document.getElementById("moving-pre"),
  document.getElementById("on-deck"),
  document.getElementById("current"),
  document.getElementById("wrap-up"),

];

var copyCards = document.getElementById("static");


   
$('input[type=radio]:checked').each(function() {
    if($(this).val() == 2){
        $(this).closest('.card-header').addClass('customer');
    };
    if($(this).val() == 3){
        $(this).closest('.card-header').addClass('di');
    };
    if($(this).val() == 4){
        $(this).closest('.card-header').addClass('qa');
    };
    if($(this).val() == 5){
        $(this).closest('.card-header').addClass('approved');
    };
});






function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}

if(getQueryVariable('display') == 'true'){
    $('html').addClass('display');
    

    var d1 = new Date (),
        d2 = new Date ( d1 );
    d2.setMinutes ( d1.getMinutes() + 5 );
    console.log( `Next refresh: ${d2}` );

    setTimeout(function() {
        window.location = window.location;
    }, 300000);
}


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


if (document.cookie.indexOf('norotate') === -1 ) {
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
  }
  