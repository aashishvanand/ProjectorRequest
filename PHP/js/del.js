$(document).ready(function(){
$('#sub-submit').on('click',function(e){
    e.preventDefault(); 
    if($('#datefield').val()=="" || $('#hour').val()==null || $('#projector').val()==null )alert("Please fill in all form data");
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
			$('#msg').html('<div class="alert alert-danger" role="alert"><strong>Warning:</strong> No Projector Booked!</div>');
			$('form')[0].reset();
	           }
                   else {
			$('#msg').html('<div class="alert alert-success" role="alert"><strong>Congratulations!</strong> You have successully cancelled a Projector</div>');
                    }          
        }
    });
   console.log('All form fields done');
   }//end of else
});//sub on click
});
