<?php 
	if(isset($_POST['action'])){
		
		$action		= $_POST['action'];
		$message 	= $_POST['message'];
		$stage_all 	= $_POST['stage'];
		$push 		= $_POST['push'];
		$pull 		= $_POST['pull'];

		$commands = array();

		//add .
		if($stage_all == 'true'){
			$commands[0] = 'git add .';
		}else{
			$commands[0] = '';
		}

		//commit
		if($message != ''){
			$commands[1] = "git commit -am '".$message."'";
		}else{
			$commands[1] = "";
		}

		//push
		if($push == 'true'){
			$commands[2] = "git push";
		}else{
			$commands[2] = "";
		}

		//pull
		if($pull == 'true'){
			$commands[3] = "git pull";
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
	<form method="post">
		<input type="hidden" name="action" value="git" />
		stage all?<br />
		<input type="text" name="stage" value="true" /><br /><br />
		
		commit message:<br />
		<input type="text" name="message" value="" /><br /><br />

		pull?<br />
		<input type="text" name="pull" value="true" /><br /><br />

		pushh?<br />
		<input type="text" name="push" value="true" />
	</form>
	<input type="button" value="lalalala" id="go">
	<pre></pre>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#go').click(function(e){
				e.preventDefault();
				var data = $('form').serialize();
				$.post('git_tool.php',data,function(r){
					$('pre').html(r);
				});
			});	
		});
	</script>

<?php		
	}
?>