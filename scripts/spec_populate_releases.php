<?php
    /**
     * GIT RELEASE EXTRACT WRAPPER SCRIPT
     *
     */

	set_error_handler(function($severity, $message, $file, $line) {
		throw new \ErrorException($message, 0, $severity, $file, $line);
	});
	set_exception_handler(function($e) {
		header('HTTP/1.1 500 Internal Server Error');
		echo "Error on line {$e->getLine()}: " . htmlSpecialChars($e->getMessage());
		die();
	});

	$err_str = "";
	$checking_hooksecret = true;
	$hooksecret_passed = false;

	// get the payload
	$raw_payload = $_REQUEST['payload'];
	if (empty($raw_payload))
		throw new \Exception("Raw payload empty");
	else {
		$payload = json_decode($raw_payload, true);
		if (empty($payload)) {
			$err_str .= "Payload can\'t be decoded";
			if (json_last_error())
				$err_str .= "; JSON error: " . json_last_error_msg();
			throw new \Exception($err_str);
		}
		else {
			// check the webhook secret
			if ($checking_hooksecret) { 
				// read the secret from a file
				$hook_secret = trim(file_get_contents ('.github_hooksecret'));
				if ($hook_secret == Null)
					throw new \Exception("Hook secret cannot be read");
				elseif (!isset($_SERVER['HTTP_X_HUB_SIGNATURE']))
					throw new \Exception("HTTP header 'X-Hub-Signature' is missing.");
				elseif (!extension_loaded('hash'))
					throw new \Exception("Missing 'hash' extension to check hook secret.");
				else {
					list($algo, $hash) = explode('=', $_SERVER['HTTP_X_HUB_SIGNATURE'], 2) + array('', '');
					if (!in_array($algo, hash_algos(), TRUE))
						throw new \Exception("Hash algorithm '$algo' is not supported.");
					elseif ($hash !== hash_hmac($algo, file_get_contents ('php://input'), $hook_secret))
						throw new \Exception("Hashes do not match.");
				}
			}
			
			// check origin and owner - must be Github/openEHR
			// (could also use just $repo_owner_name = $payload['repository']['owner']['name'];)
			$html_url = $payload['repository']['owner']['html_url'];
			if ($html_url !== 'https://github.com/openEHR')
				throw new \Exception("Wrong caller - " . $html_url);
			else {

				$repo_name = $payload['repository']['name'];

				// The commands
				$commands = array(
					'echo $PWD',
					"whoami",
					"./spec_populate_releases.sh $repo_name 2>&1"
					// "./spec_populate_releases.sh $repo_name 2>&1 &" // run in background to avoid GitHub webhook timeout
				);

				// Run the commands and collect output
				$output = '';
				$cmd_output = '';
				foreach ($commands AS $command) {
					exec($command, $cmd_output);
					$output .= htmlentities('----------- execute ' . $command . ' --------------' . PHP_EOL . implode(PHP_EOL, $cmd_output) . PHP_EOL);
				}
			}
		}
	}

    // Make it pretty for manual user access (and why not?)
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>GIT openEHR Release publishing script</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
 .  ____  .
 |/      \|
[| <span style="color: #FF0000;">&hearts;    &hearts;</span> |]  | Git openEHR releases publishing Script v0.4 |
 |___==___|  /              &copy; wolandscat 2018 |

<pre>
<?php echo $output; ?>
</pre>
</body>
</html> 
