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
  document.getElementById("static"),
  document.getElementById("trash")
];

var copyCards = document.getElementById("static");

var drake = dragula(staticColumns, {
  ignoreInputTextSelection: true,
  revertOnSpill: true,
  copy: function(el, source) {
    if (source === copyCards) {
      let theCopy = el.className === "card";
      return theCopy;
    } else {
      return false;
    }
  },
  copySortSource: false,
  accepts: function(el, target, source, sibling) {
    if (target !== copyCards) {
      return true;
    }
  }
});


drake.on('drag', function(el, source) {
    var currentClass = el.parentNode.id;
    el.classList.remove(currentClass);

        $("#trash").addClass("show");
        $("#trash").removeClass("hidden");
        

    if(el.parentNode.id == "static"){
        $("#trash").removeClass("show");
        $("#trash").addClass("hidden");
    }
});

drake.on('drop', function(el) {
    var currentClass = el.parentNode.id;
    var currentId = el.id;  
    var theId = currentId.substring(5);
    var copyTitle = el.querySelector("h3").textContent; 

    if(currentClass == "trash"){
        $.ajax({
            type: "POST",
            url: "app.php",
            data: {id:theId, method:"delete"},

            success:function(data){
                
            }
        });
        el.remove();
        delete el;
        $("#trash").removeClass("show");
        $("#trash").addClass("hidden");
       
    } else if(currentClass !== "trash"){
        $("#trash").removeClass("show");
        $("#trash").addClass("hidden");
    }

    if(currentClass !== '' && currentId !== ''){ 
        el.dataset.column = currentClass;

         $.ajax({
            type: "POST",          
            url: "app.php",
            data: {id:theId, location:currentClass,method:"update_col"},

            success:function(data){

            }
        });




    } else if(currentId == ''){
        $.ajax({
            type: "POST", 
            url: "app.php",
            data: {method:"new", title:copyTitle, location:currentClass},
            success:function(data){
                location.reload();
            }
        });
        
    } else {
        el.cancel();
    }

});


$('.card-title h3').on('blur',function(){
    var title = $('.card-title h3').html();
    var currentId = $(this).parent().parent().parent().attr('id');
    var theId = currentId.substring(5);
    if (title!=$(this).html()){
        var title = $(this).html();
        console.log(title);
        $.ajax({
            type: "POST", 
            url: "app.php",
            data: {method:"card_title", id:theId, title:title},
            success:function(data){

            }
        });
    }; 
});

$('.card-body div').on('blur',function(){
    var note = $('.card-body .card-content').html();
    var currentId = $(this).parent().parent().attr('id');
    var theId = currentId.substring(5);
    


    

        var note = $(this).html();
        
        if(note !=''){
            $(this).parent().parent().find('.card-information span.notes-icon').removeClass('hide');
        } else{
            $(this).parent().parent().find('.card-information span.notes-icon').addClass('hide');
        }


        $.ajax({
        type: "POST", 
        url: "app.php",
        data: {method:"note", id:theId, message:note},
        success:function(data){

        }
    });
});



    
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


$('input[type=radio]').change(function() {
    var currentId = $(this).parent().parent().parent().parent().parent().parent().attr('id');
    var theId = currentId.substring(5);
    var statusOption = $(this).prop('checked', true).val();

    if($(this).val() == 1){
        $(this).closest('.card-header').removeClass('di');
        $(this).closest('.card-header').removeClass('customer');
        $(this).closest('.card-header').removeClass('qa');
        $(this).closest('.card-header').removeClass('approved');
    };

    if($(this).val() == 2){
        $(this).closest('.card-header').addClass('customer');
        $(this).closest('.card-header').removeClass('di');
        $(this).closest('.card-header').removeClass('qa');
        $(this).closest('.card-header').removeClass('approved');
    };

    if($(this).val() == 3){
        $(this).closest('.card-header').addClass('di');
        $(this).closest('.card-header').removeClass('customer');
        $(this).closest('.card-header').removeClass('qa');
        $(this).closest('.card-header').removeClass('approved');
    };

    if($(this).val() == 4){
        $(this).closest('.card-header').addClass('qa');
        $(this).closest('.card-header').removeClass('customer');
        $(this).closest('.card-header').removeClass('di');
        $(this).closest('.card-header').removeClass('approved');
    };

    if($(this).val() == 5){
        $(this).closest('.card-header').addClass('approved');
        $(this).closest('.card-header').removeClass('qa');
        $(this).closest('.card-header').removeClass('customer');
        $(this).closest('.card-header').removeClass('di');
    };
 
    $.ajax({
        type: "POST",
        url: "app.php",
        data: {method:"status", id:theId, option:statusOption},
        success:function(data){
            $('.options').hide();
        }
    });
});


$('.card-options').click(function(e) {
    var $this = $(this).parent().find('.options');
    e.stopPropagation();
    $this.toggle();
});

$(document).click( function(){
     $('.options').hide();
});

$(document).mouseup( function(){
     $("#trash").removeClass("show");
     $("#trash").addClass("hidden");
});


$('.card-header').on('dblclick',function() {
    var $this = $(this).parent().find('.card-body');
    $this.toggle();
});

$('span.expand-colapse').on('click', function(){
    $(this).text(function(i, text){
          return text === "Expand All" ? "Collapse All" : "Expand All";
      });


    var $this = $(this).parent().parent().children('.column-content').find('.card-body');
      $this.toggle();    
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