<?php
	session_start();
	if(!isset($_SESSION["quizTopic"])) 
		header("Location: http://localhost/printful/index.php");
?>


<!DOCTYPE html>
<html>
   <title> Quiz System </title>   
   <head>			
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/style.css">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"> </script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   </head>
   
   <body>
	<div class="container">
	<div class="quiz-frm">
		<div class="question-window">
		  
		  <div class="form-group">
			<label for="taskname" class="caption question"><b class="question-caption"></b></label>
		  </div>
		  
		  <div class="form-group result-data">
			<label for="taskname" class="caption question"><b class="result-caption"></b></label>
		  </div>
		  
			<span class="ans-set-1 ans-set">
				<div class="input-group mb-3">
				  <button type="button" class="btn btn-primary ans-btn ans-btn-a">Answer 1</button>
				</div>	
				
				<div class="input-group mb-3">
				  <button type="button" class="btn btn-primary ans-btn ans-btn-b">Answer 2</button>
				</div>	
			</span>
			
			<span class="ans-set-2 ans-set">
				<div class="input-group mb-3">
				  <button type="button" class="btn btn-primary ans-btn ans-btn-c">Answer 3</button>
				</div>	
				
				<div class="input-group mb-3">
				  <button type="button" class="btn btn-primary ans-btn ans-btn-d">Answer 4</button>
				</div>	
			</span>
		 
		  <button type="button" class="btn btn-default enter-test">Next</button>
		</div>
	  </div>
	  </div>
   </body>
</html>

<script>
$(document).ready(function()
{
	var quiz_num 	   = 0;
	var quiz_data 	   = [];
	var question_ 	   = null;
	var array_size_    = 0;
	var answer_btn_val = null; 		
	
	
	/// Fetch question and answer set into array on page load
	$.ajax({
		   type:"POST",
		   url:"fetchQuiz.php",
		   data:{"action":"fetch","fetch_type":1, "quiz_type":1},
	       success: function(data_)
		   {
			   var parseQuizs = jQuery.parseJSON(data_);
			   push_data(parseQuizs);
		   }
	});
	//// End of function 
	
	/// Next button click function 
	$(".enter-test").on("click",function()
	{
		quiz_num += 1;
		if(array_size_ - 1 > quiz_num)
		{
			$(".question-caption").html(quiz_data[quiz_num][0]);
			$(".ans-btn-a").html(quiz_data[quiz_num][1]);
			$(".ans-btn-b").html(quiz_data[quiz_num][2]);
			$(".ans-btn-c").html(quiz_data[quiz_num][3]);
			$(".ans-btn-d").html(quiz_data[quiz_num][4]);
			getNextquestion();
		}
		
		else
		{
			$(".ans-set").hide();
			$(".enter-test").hide();
			$(".question-caption").html(quiz_data[quiz_num]);
			get_result_data(); // Call result function after finish the test 
		}
	});
	//// End of function 
	
	//// Result Function
	function get_result_data()
	{
		$.ajax(
		{
		   type:"POST",
		   url:"checkAnswer.php",
		   data:{"showResult":"checkAnswer"},
		   success: function(data_)
		   {
			  var parseQuizs = jQuery.parseJSON(data_);
			  $(".result-caption").html("<b> Correct Answer : "+parseQuizs.correct_answer+"  Incorrect Answer : "+parseQuizs.incorrect_answer+" Not Answered : "+parseQuizs.not_answerd);
			  $(".result-data").show();
		   }
		});	
	}
	/// End of the function 
	
	/// Fill the array after get result by ajax
	function push_data(dat_array)
	{
		quiz_data = dat_array;
		quiz_data.push($("#drop").val());
		$(".question-caption").html(quiz_data[quiz_num][0]);
		$(".ans-btn-a").html(quiz_data[quiz_num][1]);
		$(".ans-btn-b").html(quiz_data[quiz_num][2]);
		$(".ans-btn-c").html(quiz_data[quiz_num][3]);
		$(".ans-btn-d").html(quiz_data[quiz_num][4]);
		array_size_ = quiz_data.length - 1;
	}
	
	/// Function to fetch next question by Ajax
	function getNextquestion() 
	{
		$.ajax(
		{
		   type:"POST",
		   url:"checkAnswer.php",
		   data:{"action":"checkAnswer", "question":question_, "answer":answer_btn_val},
		   success: function(data_)
		   {
			   $(".enter-test").show();
			   answer_btn_val = null;
			   question_ = null;
		   }
		});	
	}
	/// End of Function
	
	/// Set the value after click on answer button
	$(".ans-btn").on("click",function()
	{
		answer_btn_val  = $(this).text();
		question_ 		= $(".question").text()
	});
	/// End of Function
});
</script>