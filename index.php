<?php 
	if(isset($_POST['action'])){
		
		$action		= $_POST['action'];
		$message 	= $_POST['message'];
		$stage_all 	= $_POST['stage'];
		$push 		= $_POST['push'];
		$pull 		= $_POST['pull'];

		$commands = array();

		//pull
		if($pull == 'true'){
			$commands[0] = "git pull";
		}else{
			$commands[0] = "";
		}

		//add .
		if($stage_all == 'true'){
			$commands[1] = 'git add .';
		}else{
			$commands[1] = '';
		}

		//commit
		if($message != ''){
			$commands[2] = "git commit -am '".$message."'";
		}else{
			$commands[2] = "";
		}

		//push
		if($push == 'true'){
			$commands[3] = "git push";
		}else{
			$commands[3] = "";
		}


		$output = '';
		foreach ($commands as $command) {
			if($command != ''){
				$a = shell_exec($command);
				if($a != ''){
					$output = $output."\ngit:\n".$a;	
				}
			}
		}

		if($output != ''){
			echo $output;	
		}else{
			echo "\n\ngit_tool:\ncommand executed successfully.";
		}
		

	}else{ 
?>
	<!doctype html>
	<charset=utf-8>
	<title>Git Tool</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
	<body>
		<div class="command">
			<form>
				git add . && <br />
				git commit -am "<input type="text" name="message" />" && <br />
				git push<br />
				<input type="button" value="Execute" class="go">
				<input type="hidden" name="action" value="git" />
				<input type="hidden" name="stage" value="true" />
				<input type="hidden" name="push" value="true" />
				<input type="hidden" name="pull" value="false" />
			</form>
		</div>
		<pre></pre>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.go').click(function(e){
					e.preventDefault();
					$('pre').html('Working...');
					var data = $(this).parent().serialize();
					$.post('index.php',data,function(r){
						$('pre').html(r);
					});
				});	
			});
		</script>
	</body>
<?php		
	}
?>