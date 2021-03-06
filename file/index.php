<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Welcome to the demo company</title>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="assets/css/csshake.min.css" media="screen">
		<link rel="stylesheet" type="text/css" href="assets/css/global.css" media="screen">
		
		
	</head>
	<body>

		<?php

		session_start();

		$_SESSION['token'] = md5(microtime());

		$token = $_SESSION['token'];

		?>

		<!--Page Wrapper Start-->
		<div id="wrapper">

			   <header id="header">
                        <div class="container">
                               <a href="javascript:void(0)" class="logo">
                                        <img src="assets/images/logo.png" alt=""/>
							   </a>
						</div>
			   </header>
				

				<!--Content Area Start-->
				<div id="content">
					<section class="banner">
						<img src="assets/images/banner.png" alt=""/>
					</section>
					<section class="feedback">
                             <div class="container">
									<div class="feedback_inner">
										<h2>

										<?php

									/*	if(isset($_GET['n']) && !empty($_GET['n']))
										{
											echo 'Hello '.$_GET['n'];
										}*/

										?>
										Your  feedback</h2>
										
										<form id="feedback_form" name="feedback_form" method="post">
											<input type="hidden" name="token" value="<?php echo $token;?>">
											<div class="feed_back_top"> 
												<p>We would like your feedback to improve our services.</p>
												<span>What is your opinion of this services ?</span>
												<div id="emoji-div"></div>
											</div>

											<div class="feedback_wrapper">
												<p>Name</p>
												<input name="name" id="name" type="text" required="">
											</div>

											<div class="feedback_wrapper">
												<p>e-mail</p>
												<input name="email" id="email" type="email" required="" maxlength="100">
											</div>

											<div class="feedback_wrapper">
												<p>Mobile</p>
												<input name="mobile" id="mobile" type="text" required="" maxlength="10" onkeypress="return isNumber(event)">
											</div>

											<div class="feedback_wrapper">
												<p>We would like your feedback to improve our services.</p>
												<textarea required="" class="feedback_area" name="msg" maxlength="300" id="msg"></textarea>
												<button  type="submit" class="submit_btn" id="submit_btn" style="cursor:pointer">
													Submit
												</button>
											</div>
										</form>
										
									</div>
							 </div>
					</section>
				</div>
				<!--Content Area End-->
                <footer id="footer">
                </footer>
				

			
		</div>
		<!--Page Wrapper End-->
		<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="https://smartsunenergy.in/review/assets/js/emoji.min.js"></script>
		<script type="text/javascript" src="assets/js/site.js"></script>

		<script type="text/javascript">

			$(document).ready(function(){
				$( "#feedback_form" ).submit(function( event ) {
				  send_rating();
				  event.preventDefault();
				});
			});

			function send_rating()
			{	
				var rating = $('#emoji-div').attr('value');
				var msg = $('#msg').val();

				var name = "<?php echo (isset($_GET['n']) && !empty($_GET['n']))?$_GET['n']:'Not found';?>";

				if(msg.length < 1)
			    {
			    	alert("Please enter feedback message.");
			    	return false;
			    }

			    if(msg.length <= 5)
			    {
			    	alert("Feedback message is too short.");
			    	return false;
			    }

			    if(rating < 1)
			    {
			    	alert("Please give the rating");
			    	return false;
			    }

			    $('#submit_btn').attr('disabled','disabled');
				$('#submit_btn').html('Please wait.');
				var data = $('#feedback_form').serialize()+"&rating=" + rating;
				
				$.ajax({
			        'url'       : 'server.php',
			        'method'    : 'POST',
			        'dataType'	: 'json',
			        //'data'	    : {'rating':rating,'msg':msg,'name':name,'token':"<?php //echo $token;?>"},
			        'data'	    : data,
			        success     : function(resp)
			        {
			        	if(resp.status == true)
			        	{
			        		$('#feedback_form input,#feedback_form textarea').val('');
			        	}

			        	$('#submit_btn').removeAttr('disabled');
						$('#submit_btn').html('Submit');
			        	
			        	alert(resp.msg);

			        },
			        error       : function(error)
			        {
			            alert('Error something went wrong. Please try after sometime');

			            $('#submit_btn').removeAttr('disabled');
						$('#submit_btn').html('Submit');
			        }
			    });
			}


			function isNumber(evt) {
			    evt = (evt) ? evt : window.event;
			    var charCode = (evt.which) ? evt.which : evt.keyCode;
			    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			        return false;
			    }
			    return true;
			}

		</script>

	</body>
</html>