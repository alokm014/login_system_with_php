$(document).ready(function(){

	//show and hide
			$("#register-btn").click(function(){
				$("#login-box").hide();
				$("#register-box").show();
			});

			$("#login-btn").click(function(){
				$("#register-box").hide();
				$("#login-box").show();
			});

			$("#forgot-btn").click(function(){
				$("#login-box").hide();
				$("#forgot-box").show();
			});

			$("#back-btn").click(function(){
				$("#forgot-box").hide();
				$("#login-box").show();
			});

		// validate form

			$("#login-form").validate({
		        messages: {},
		        highlight: function (element) {
		            $(element).parent().addClass('error')
		        },
		        unhighlight: function (element) {
		            $(element).parent().removeClass('error')
		        }
			});

			$("#register-form").validate({
		        messages: {},
		        highlight: function (element) {
		            $(element).parent().addClass('error')
		        },
		        unhighlight: function (element) {
		            $(element).parent().removeClass('error')
		        },

				rules:{
					cpswd:{
						equalTo: "#pswd",
					}
				}

			});

			$("#forgot-form").validate({
		        messages: {},
		        highlight: function (element) {
		            $(element).parent().addClass('error')
		        },
		        unhighlight: function (element) {
		            $(element).parent().removeClass('error')
		        }
			});

			//submit without refresh for registration form
			$("#register").click(function(e){
				if(document.getElementById('register-form').checkValidity()){
					e.preventDefault();
					$("#loader").show();
					$.ajax({
						url:'action.php',
						method:'post',
						data:$("#register-form").serialize()+'&action=register',
						success: function(response){
							$("#alert").show();
							$("#loader").hide();
							$("#result").html(response);
						}
					});
				}
				return true;
			});

			//submit without refresh for login form
			$("#login").click(function(e){
				if(document.getElementById('login-form').checkValidity()){
					e.preventDefault();
					$("#loader").show();
					$.ajax({
						url:'action.php',
						method:'post',
						data:$("#login-form").serialize()+'&action=login',
						success: function(response){
							if(response=="ok"){
								window.location="dashboard/index.php";
							}
							else{
								$("#alert").show();
								$("#result").html(response);
								$("#loader").hide();
							}
						}
					});
				}
				return true;
			});

			//submit without refresh for forgot form
			$("#forgot").click(function(e){
				if(document.getElementById('forgot-form').checkValidity()){
					e.preventDefault();
					$("#loader").show();
					$.ajax({
						url:'action.php',
						method:'post',
						data:$("#forgot-form").serialize()+'&action=forgot',
						success: function(response){
							$("#alert").show();
							$("#result").html(response);
							$("#loader").hide();
						}
					});
				}
				return true;
			});


		});
