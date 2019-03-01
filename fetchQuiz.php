<?php
  require_once("init.php");
  
  class fetchQuiz extends init
  {
	public $int_		  = null;
	public $result_array_ = array();
	
	function __construct()
	{	
		$this->int_ = new init();
	}
	
	/// Get Test Types from Database 
	public function fetchQuizType()
	{
		$sql = "SELECT * FROM quiz_list";
		$result = $this->int_->conn->query($sql);
		
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()) 
			{
				array_push($this->result_array_, array($row["quiz_id"]=>$row["quiz_name"]));
			}
			echo json_encode($this->result_array_);
		}
	}
	
	/// Get the Questions regarding to selected type of test
	public function fetchQuizQuestions($quizType)  // Fetch quiz type
	{
		$this->result_array_ = [];
		$sql = "SELECT * FROM quiz_quesrions where quiz_id = ".$_SESSION["quizTopic"];
		$result = $this->int_->conn->query($sql);
		
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()) 
			{
				array_push($this->result_array_, array($row["quiz_question"], 
													   utf8_encode($row["quiz_answer_a"]), 
													   utf8_encode($row["quiz_answer_b"]),
													   utf8_encode($row["quiz_answer_c"]),
													   utf8_encode($row["quiz_answer_d"])));
			}
			
			array_push($this->result_array_, "<b>Thank you ".$_SESSION["candidate_name"]."</b>");
			echo json_encode($this->result_array_, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}
  }
  
  
  // Call Function according to post value
  if(isset($_POST["action"]))
  {
	/// Fetch all test type 
	if($_POST["action"] == "fetch" && $_POST["fetch_type"] == 0)
	{
		$quiz_ = new fetchQuiz(); 
		$quiz_->fetchQuizType();
	}
	
	/// Set the test Type 
	if($_POST["action"] == "setTest" && isset($_POST["candidate_name"]))
	{
		$quiz_ = new fetchQuiz();
		session_start();
		if(isset($_POST["quizTopic"]))
		{
			unset($_SESSION["quizTopic"]);
			unset($_SESSION["candidate_name"]);	
			$_SESSION["quizTopic"] 		= strip_tags($_POST["quizTopic"]);
			$_SESSION["candidate_name"] = strip_tags($_POST["candidate_name"]);
		}
	}
	
	/// Fetch questions regarding to quiz type 
	if($_POST["action"] == "fetch" && $_POST["fetch_type"] == 1)
	{
		$quiz_ = new fetchQuiz();
		session_start();
		$quiz_->fetchQuizQuestions($_SESSION["quizTopic"]);
	}
  }
?>