<?php
    /**
     * GIT RELEASE EXTRACT WRAPPER SCRIPT
     *
     */

	$error = '';

	// get the payload
	if (!empty($_REQUEST['payload'])) {
		$payload = json_decode($_REQUEST['payload'], true);
		if (!empty($payload) && !empty($payload['repository'])) {
			// check origin and owner - must be Github/openEHR
			// (could also use just $repo_owner_name = $payload['repository']['owner']['name'];)
			$html_url = $payload['repository']['owner']['html_url'];
			if ($html_url == 'https://github.com/openEHR') {

				$repo_name = $payload['repository']['name'];

				// The commands
				$commands = array(
					'echo $PWD',
					"whoami",
					"./spec_populate_original_releases.sh $repo_name &" // run in background to avoid GitHub webhook timeout
				);

				// Run the commands and collect output
				$output = '';
				foreach ($commands AS $command){
					$tmp = shell_exec($command);
					$output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
					$output .= htmlentities(trim($tmp)) . "\n";
				}
			}
			else 
				$error .= 'Wrong caller - ' . $html_url;
		}
		else {
			$error .= 'Payload can\'t be decoded: ' . $_REQUEST['payload'] . "\n";
			if (json_last_error()) {
				$error .= 'JSON error: ' . json_last_error_msg();
			}
		}
	}
	else 
		$error .= 'Payload variable empty';

    // Make it pretty for manual user access (and why not?)
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>GIT openEHR Release publishing script</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>
 .  ____  .
 |/      \|
[| <span style="color: #FF0000;">&hearts;    &hearts;</span> |]  | Git openEHR releases publishing Script v0.4 |
 |___==___|  /              &copy; wolandscat 2018 |

----------- output --------------
<?php echo $output; ?>
----------- errors --------------
<?php echo $error; ?>
</pre>
</body>
</html> 

