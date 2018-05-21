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

    if(currentClass !== "" && currentId !== ''){ 
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




$('.card h3').on('blur',function(){
    var title = $('.card h3').html();
    var currentId = $(this).parent().parent().attr('id');
    var theId = currentId.substring(5);
    if (title!=$(this).html()){
        var title = $(this).html();
        $.ajax({
            type: "POST", 
            url: "app.php",
            data: {method:"card_title", id:theId, title:title},
            success:function(data){

            }
        });
    }; 
});

$('.card p').on('blur',function(){
    var note = $('.card p').html();
    var currentId = $(this).parent().parent().attr('id');
    var theId = currentId.substring(5);
    if (note!=$(this).html()){
        var note = $(this).html();

        $.ajax({
            type: "POST", 
            url: "app.php",
            data: {method:"note", id:theId, message:note},
            success:function(data){
 
            }
        });
    }; 
});



    
$('select option:selected' ).each(function() {
    if($(this).val() == 2){
        $(this).closest('.card-title').addClass('customer');
    };
    if($(this).val() == 3){
        $(this).closest('.card-title').addClass('di');
    };
});


$('select').change(function() {
    var currentId = $(this).parent().parent().parent().parent().attr('id');
    var theId = currentId.substring(5);
    var statusOption = $(this).val();

    if($(this).val() == 1){
        $(this).closest('.card-title').removeClass('di customer');
        $(this).closest('.card-title').removeClass('customer');
    };

    if($(this).val() == 2){
        $(this).closest('.card-title').addClass('customer');
        $(this).closest('.card-title').removeClass('di');
    };

    if($(this).val() == 3){
        $(this).closest('.card-title').addClass('di');
        $(this).closest('.card-title').removeClass('customer');
    };
 
    $.ajax({
        type: "POST", 
        url: "app.php",
        data: {method:"status", id:theId, option:statusOption},
        success:function(data){

        }
    });
});

$('.gear').on('click',function() {
    var $this = $(this).parent().find('.options');
    $this.toggle();
});

$('.card-title').on('dblclick',function() {
    var $this = $(this).parent().find('.description');
    $this.toggle();
});