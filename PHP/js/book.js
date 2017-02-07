$(document).ready(function(){
$('#sub-submit').on('click',function(e){
    e.preventDefault(); 
    if($('#datefield').val()=="" || $('#hour').val()==null || $('#projector').val()==null || $('#year').val()==null || $('#department').val()==null || $('#section').val()==null )alert("Please fill in all form data");
    else {
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $('form').attr('action'),
        data     : $('form').serialize(),
        success  : function(data) {
        	   var obj = JSON.parse(data);
		   console.log(obj);
                   if(obj.msg=="0"){
			$('#msg').html('<div class="alert alert-danger" role="alert"><strong>Warning:</strong> You have already booked a Projector</div>');
			$('form')[0].reset();
	           }
                   else {
			$('#msg').html('<div class="alert alert-success" role="alert"><strong>Congratulations!</strong> You have successully booked a Projector</div>');
                    }          
        }
    });
   console.log('All form fields done');
   }//end of else
});//sub on click
});

/*
date:2017-02-04
hour:1
projector:Projector 1 - Dell
year:I
department:cse
section:A
insert:
*/
