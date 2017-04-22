// JavaScript Document
$(document).ready(function()
{
	var state_id = $("#state_id").val();
		$.ajax({
			url: base_url+'employee/get_edit_city',
			data: {state_id : state_id  },
			type: "post",
			success: function( data ) 
			{
				if(data != '')
				{
					$('.edit_city_id').html(data);
					$(".edit_city_id").trigger("chosen:updated");
				}
			}
		});	
	$( "body" ).on( "change", "#state_id", function() {
		var state_id = $(this).val();
		$.ajax({
			url: base_url+'employee/get_city',
			data: {state_id : state_id  },
			type: "post",
			success: function( data ) 
			{
				if(data != '')
				{
					$('#city_id').html(data);
					$("#city_id").trigger("chosen:updated");
				}
			}
		});
	});
	$('#employee_table').DataTable();
	/*
	$('#submit').click(function(e) {
		e.preventDefault();
		var data = new FormData( $("#catgory_form")[0]); // <-- 'this' is your form element		
		$.ajax({
			url: 'ajax_addnew',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function(data) {
				
				if(data == 'Success')
				{
					window.location.href = "listing";
					//$('.message').html('<div class="alert alert-danger">Category Already Exit.<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>');
				}
				else if(data == 'Duplicate')
				{
					window.location.href = "addnew";
					$('.message').html('<div class="alert alert-danger">Category Already Exit.<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>');
				}
				//window.location.href = "listing";
			}

		});
		return false;
	});
	*/
});
function confirmDialog() 
{
    return confirm("Are you sure you want to delete this record?")
}
function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode;
  if (charCode != 46 && charCode > 31 
	&& (charCode < 48 || charCode > 57))
	 return false;
  return true;
}
