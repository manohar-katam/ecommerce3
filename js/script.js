// Slider image script
$(document).ready( function() {
    $('#myCarousel').carousel({
		interval:   4000
	});
	
	var clickEvent = false;
	$('#myCarousel').on('click', '.nav a', function() {
			clickEvent = true;
			$('.nav li').removeClass('active');
			$(this).parent().addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.nav').children().length -1;
			var current = $('.nav li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.nav li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
	// End of Slider image script

	
	// Registration
	$("#signupSubmit").click(function(event){
		event.preventDefault();  // To stop the refresh of page

			$.ajax({
				url     : "register_confirm.php",
				method  : "POST",
				data    : $("form").serialize(),
				success : function(data){
					$("#signupMsg").html(data);
					if(data == "Successful"){
						alert('Registration Successful !!! Please Login to your account');
						window.location.href = "login.php";
					}
				}
			})
	});
	// Admin Registration
	$("#AdminsignupSubmit").click(function(event){
		event.preventDefault();  // To stop the refresh of page

			$.ajax({
				url     : "AdminRegister_Confirm.php",
				method  : "POST",
				data    : $("form").serialize(),
				success : function(data){
					$("#AdminsignupMsg").html(data);
					if(data == "Successful"){
						alert('Registration Successful !!! New Admin can now Login to his account');
						window.location.href = "Admin/AdminLogIn.php";
					}
				}
			})
	});

	// Login or Sign In
	$("#signinSubmit").click(function(event){
		event.preventDefault();  // To stop the refresh of page
			$.ajax({
				url     : "login_confirm.php",
				method  : "POST",
				data    : $("form").serialize(),
				success : function(data){
					$("#signinMsg").html(data);
					if(data == "true"){
						window.location.href = "profile.php";
					}
				}
			})
	});
		// Admin Login or Sign In
	



	// Editing in Account
	$("#update").click(function(event){
		event.preventDefault();  // To stop the refresh of page
			$.ajax({
				url     : "account_edit.php",
				method  : "POST",
				data    : $("form").serialize(),
				success : function(data){
					$("#updatemsg").html(data);
				}
			})
	});

	// Deleting Account
	$("#delete").click(function(event){
		event.preventDefault();  // To stop the refresh of page
			$.ajax({
				url     : "del_acc_confirm.php",
				method  : "POST",
				data    : $("form").serialize(),
				success : function(data){
					if(data == "Successful"){
						alert('Account DELETED Successfully !!!');
						window.location.href = "Admin/UserProfiles.php";
					}
				}
			})
	});

	// Cancelling Editing Account and Deleting Account
	$("#cancelBtn").click(function(event){
		event.preventDefault();  // To stop the refresh of page
			$.ajax({
				url     : "del_can_confirm.php",
				method  : "POST",
				data    : $("form").serialize(),
				success : function(data){
					if(data == "Successful"){
						window.location.href = "Admin/UserProfiles.php";
					}
				}
			})
	});

	// Updating Password
	$("#updatePassword").click(function(event){
		event.preventDefault();  // To stop the refresh of page
			$.ajax({
				url     : "update_password.php",
				method  : "POST",
				data    : $("form").serialize(),
				success : function(data){
					$("#changePasswordMsg").html(data);
				}
			})
	});

	// Updating Email
	$("#updateEmail").click(function(event){
		event.preventDefault();  // To stop the refresh of page
			$.ajax({
				url     : "update_email.php",
				method  : "POST",
				data    : $("form").serialize(),
				success : function(data){
					$("#changeEmailMsg").html(data);
				}
			})
	});

	$("#AdminsigninSubmit").click(function(event){
		event.preventDefault();  // To stop the refresh of page
			$.ajax({
				url     : "AdminLogIn_Confirm.php",
				method  : "POST",
				data    : $("form").serialize(),
				success : function(data){
					$("#AdminsigninMsg").html(data);
					if(data == "true"){

						window.location.href = "AdminProfile.php";
					}
				}
			})
	});

getUserProfiles();
function getUserProfiles(){
		event.preventDefault();  // To stop the refresh of page
			$.ajax({
				url     : "getUsers.php",
				method  : "POST",
				data    : $("form").serialize(),
				success : function(data){
					$("#UserProfilesTable").html(data);
					if(data == "true"){
						window.location.href = "AdminProfile.php";
					}
				}
			})
	};


});
