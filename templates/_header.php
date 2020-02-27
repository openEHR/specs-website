<!DOCTYPE HTML>

<html lang="en">

<head>
	
	<title>openEHR - <?php echo "$PageName";?></title>
	<meta charset="utf-8">	
	<meta name="description" content="openEHR provides open source specifications and reference implementations of future proof EHR systems">
	<meta name="keywords" content="archetypes, openEHR, EHR, electronic health record, electronic medical record, ADL, reference model, clinical models, healthcare, health informatics, medical informatics, EHR standards, ISO 18308, CEN 13606, health care software, open source software, knowledge modelling, patient-centric">
	<meta name="author" content="openEHR Foundation">
	<meta name="designer" content="Adriana Danilakova">
	<meta name="rating" content="General">
	<meta name="robots" content="All">
	<meta name="revisit-after" content="5 days">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="/styles/basic.css"  type="text/css">
	<link rel="stylesheet" href="/styles/pages.css"  type="text/css"> 
	
	<link rel="shortcut icon" href="/favicon.ico">
    <link rel="icon" sizes="16x16 32x32" href="/favicon.ico">

    <link rel="home" href="/">

	<meta name="google-site-verification" content="zfPZfHQ-5oXYT119aAi7HdZELv8ubHPCxvIFANVPzcU" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	<script src="/functions/menu_dropdown.js"></script> 
	<script src="/functions/paragraph_dropdown.js"></script>
	
	<?php
	$pageOn = basename($_SERVER['PHP_SELF']);
	$portuguese = 'https://'.str_replace('.org','.org/pt',$_SERVER['SERVER_NAME']).$_SERVER['PHP_SELF'];
	$spanish = 'https://'.str_replace('.org','.org/es',$_SERVER['SERVER_NAME']).$_SERVER['PHP_SELF'];
	?>
	
</head>

<body>

<div id="MainFrame">
	
	<div id="TopPanelContainer">
	
		<div id="TopPanel">
			
			<div id="Logo">

				<a href="/"></a>
				
			</div>
				
			<div id="Motto">
			
				Open industry specifications, models and software for e-health
			
			</div>
			
			<div id="Utilities">
				
				<a href="https://www.openehr.org">openEHR Home</a> | <a href="/wiki" target="_blank">Wiki</a> | <a href="https://openehr.atlassian.net/secure/BrowseProjects.jspa?selectedCategory=all&selectedProjectType=all" target="_blank">Jira</a> | <a href="https://www.openehr.org/ckm">CKM</a>
				
				<div id="Search">
			
					<script>
					  (function() {
						var cx = '013258992131926468583:q3vo4hyneyu';
						var gcse = document.createElement('script');
						gcse.type = 'text/javascript';
						gcse.async = true;
						gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
						var s = document.getElementsByTagName('script')[0];
						s.parentNode.insertBefore(gcse, s);
					  })();
					</script>
					<gcse:search></gcse:search>

				</div>
			
			</div>
			
		</div>
	
	</div>
	
	<div id = "TopMenuContainer">
	
		<div id="TopMenu">
			<?php include $_SERVER['DOCUMENT_ROOT'].'/menu/topmenu.php' ?>
		</div> 
		
	</div>

	<div id = "MainAreaContainer">
	
	<div id="MainArea">
		
		<div id="SideMenu">
			<?php include 'menu.php' ?>
		</div>
		
