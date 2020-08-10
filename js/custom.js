
  
  
  jQuery(document ).ready(function() {
	  
	   $("#uname").keyup(function () {
		  var regex = /^[a-zA-Z ]*$/;
				if (regex.test($("#uname").val())) {
					var message= "Valid";
				} else {
					alert("User Name accepts only character");
				}
		});  
		$("#phone").keypress(function (e) {
     
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					alert("Mobile accepts only Numbers");
					   return false;
			}
		});
		
		$("#createUser").submit(function () {
			var pwd = $("#pwd").val();
			var cpwd = $("#cpwd").val();
			if(pwd != cpwd){
				alert("Password and Confirm passwords are not matching");
				return false;
			}
		});
		
		$(".click-me").click(function () {
			//alert("Called")
			var id = $(this).attr('id');			 
			var res = id.split("_");			
			var qid = "#qdiv_" +res[1];
			//alert(qid)
			//$("qdiv_1").removeClass('quantity-div');
			$(qid).removeClass('quantity-div');
		});
		$(".user-id").click(function () {
			//alert("Called")
			var id = $(this).attr('id');			 
			var res = id.split("_");			
			
		});
  });