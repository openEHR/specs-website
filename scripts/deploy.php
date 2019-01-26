<?php
    /**
     * GIT DEPLOYMENT SCRIPT
     *
     */

    // The commands
    $commands = array(
        'echo $PWD',
        'whoami',
        'git pull',
        'git log -n 3',
        'git --work-tree=%worktree% checkout -f ',
		'git status',
		'chmod ug+x scripts/*.sh'
    );

    // Run the commands for output
    $output = '';

	// get directory like /var/www/vhosts/openehr.org/specifications.openehr.org
    $worktree = dirname (getcwd());

	// get sitename like specifications.openehr.org
    $sitename = basename ($worktree);

	// determine repo location as /var/www/git/specifications.openehr.org
    $repodir = "/var/www/git/" . $sitename;
    chdir ($repodir);

    $output .= "chdir (" . $repodir . ")\n";

    foreach ($commands AS $command){

        $cmd_str = str_replace ("%worktree%", $worktree, $command);

        // Run it
        $tmp = shell_exec($cmd_str);
        // Output
        $output .= "--- {$cmd_str} ---\n";
        $output .= htmlentities(trim($tmp)) . "\n";
    }
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>GIT DEPLOYMENT SCRIPT</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>
<?php echo $output; ?>
</pre>
</body>
</html> 
