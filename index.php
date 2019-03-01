<?php
	session_start();
	if(isset($_SESSION["quizTopic"]))
	{
		unset($_SESSION["quizTopic"]);
	}
?>

<!DOCTYPE html>
<html>
   <title> Quiz System </title>
   
   <head>			
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="quiz/style.css">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"> </script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   </head>
   
   <body>
	<div class="quiz-frm">
		<form action="">
		  
		  <div class="form-group">
			<label for="taskname" class="caption"><b>Technical Task</b></label>
			<input type="text" class="form-control name_" id="name" placeholder="Enter your name" name="name_">
		  </div>
		  
			<div class="input-group mb-3">
			  <select class="custom-select" id="quizType">
			  </select>
			</div>		  
		 
		  <button type="button" class="btn btn-default enter-test">Submit</button>
		
		</form>
	  </div>
   </body>
</html>

<script>
$(document).ready(function()
{
	/// Fetch all test type after page load
	$.ajax({
		   type:"POST",
		   url:"fetchQuiz.php",
		   data:{"action":"fetch","fetch_type":0},  // Parameter to fetch all the questions 
		   success: function(data_)
		   {
			   var parseQuizs = jQuery.parseJSON(data_);
			   var quizHtml	  = "<option selected>Choose Your Test ...</option>";
			   
			   $.each(parseQuizs, function(idx, value)
			   {
				  
				  quizHtml += "<option value='"+(idx+1)+"'>"+value[idx+1]+"</option>";
			   });
			   
			   $("#quizType").html(quizHtml);
		   }
	});
	
	/// Redirect the page after change the quiz type
	$("#quizType").on("change",function()
	{
		$.ajax(
		{
		   type:"POST",
		   url:"fetchQuiz.php",
		   data:{"action":"setTest","quizTopic":$(this).val(),"candidate_name":$(".name_").val()},
		   success: function(data_)
		   {
			   window.location = "quizPage.php";
		   }
		});
	});
	///////////////////////// 
});
</script>
