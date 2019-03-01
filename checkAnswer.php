<?php
  require_once("init.php");
  session_start();
  
  class checkAnswer extends init
  {
	public $result_array_ = array();
	public $int_		  = null;
	
	function __construct()
	{	
		$this->int_ = new init(); // Initializing of the checkAnswer class 
	}
	
	/// Check the answer and update result table according to it. 
	public function processAnswer($question, $answer)
	{
		if(!empty($answer) && $answer != "" && $answer != " " && isset($answer) && $answer != null)
		{
			$sql      		  = "select * from quiz_quesrions where quiz_question Like '%$question' and quiz_correct_answer Like '%$answer'";
			$ans_query 		  = "select * from quiz_result where candidiate_name Like '%".$_SESSION["candidate_name"]."'";
			
			$result   	  	  = $this->int_->conn->query($sql);
			$answer			  = $this->int_->conn->query($ans_query);
			
			$corr_answer 	  = 0;
			$wrong_answer 	  = 0;
			
			
			if ($result->num_rows > 0)  // True -> Only the answer will be true
			{
				$corr_answer = 1;
				if($answer->num_rows > 0)
				{
					$get_prev_answer = $answer->fetch_assoc();			
					$updateAnswer = "update quiz_result set correct_answer = ".(int)($get_prev_answer["correct_answer"] + $corr_answer)." where candidiate_name Like '%".$_SESSION["candidate_name"]."'";
					$this->int_->conn->query($updateAnswer);
				}
			}
			
			else                           // No resule if the answer is wrong
			{
				$wrong_answer = 1;	
				if($answer->num_rows > 0)
				{
					$get_prev_answer = $answer->fetch_assoc();
					$updateAnswer = "update quiz_result set incorrect_answer = ".(int)($get_prev_answer["incorrect_answer"] + $wrong_answer)." where candidiate_name Like '%".$_SESSION["candidate_name"]."'";
					$this->int_->conn->query($updateAnswer);
				}
			}
			
			if($answer->num_rows == 0) // Insert first record in resule table 
			{
				$insertNewAnswer = "insert into quiz_result values(0, ".$_SESSION["quizTopic"].", '".$_SESSION["candidate_name"]."', $corr_answer, $wrong_answer, 0)";
				$this->int_->conn->query($insertNewAnswer);
				$this->ans_table_empty = 0;
			}
			$corr_answer 	  = 0;
			$wrong_answer 	  = 0;
		}
		
		else
		{
			$updateAnswer = "update quiz_result set not_answerd = not_answerd + 1 where candidiate_name Like '%".$_SESSION["candidate_name"]."'";
			$this->int_->conn->query($updateAnswer);
		}
	}
	
	//// Fetch resule from table 
	public function getResult()
	{
		$ans_array_ 	   = array();
		$resut_ans_sql     = "SELECT * FROM `quiz_result` Left join quiz_list on quiz_result.quiz_id = quiz_list.quiz_id where quiz_result.candidiate_name = '".$_SESSION["candidate_name"]."'";
		$ans_resut_set     = $this->int_->conn->query($resut_ans_sql);
		$quiz_result_data_ = $ans_resut_set->fetch_assoc();
		echo json_encode($quiz_result_data_);
	}
	//// End the result function
	
  }
  //////// End of processAnswer 
  
  /// Check question answer if it is correct according to post value
  if(isset($_POST["action"]))
  {
	if(isset($_POST["question"]) && isset($_POST["answer"]))
	{
		$quiz_ = new checkAnswer();
		$quiz_->processAnswer(strip_tags($_POST["question"]), strip_tags($_POST["answer"]));
	}
  }
  
  /// Check post value if user request to see the result.
  if(isset($_POST["showResult"]))
  {
	$quiz_ = new checkAnswer();
	$quiz_->getResult();
  }
  /// Post value checking end
  
?>