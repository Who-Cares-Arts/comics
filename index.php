<?php
    // First define whatever the document root is. 
    define ("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);

    // include/require any necessary scripts
	require_once(DOCUMENT_ROOT.'/lib/sqlFunctions.php');
	require_once(DOCUMENT_ROOT.'/lib/Flowerpot.php');
	require_once(DOCUMENT_ROOT.'/lib/siteFunctions.php');

    // Start your session then perform any session functions
    session_start();

    // Such as checking to see if this session being passed actually exists in the server.
    if ((!$_COOKIE[session_name()]) && $_GET['passed_id']) {
        if (check_session_exists($_GET['passed_id'])) { 
            session_id($_GET['passed_id']);
        }
    }

    // Finalize any necessary session details.
    // This part is left blank for the sample.

	DOCTYPE();
	HTML_Begin();
	HEAD_Begin();
		TITLE_Begin();
			WriteLine("Who Cares? Arts");
		TITLE_End();
		WriteLine('<meta charset="UTF-8">');
		WriteLine('<meta name="viewport" content="width=device-width, initial-scale=1">');
		WriteLine('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">');
		WriteLine('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>');
		WriteLine('<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>');
		WriteLine('<style> body { font-size: 16pt; } </style>');
		WriteLine('<script type="text/javascript" src="//use.typekit.net/cxm0mpv.js"></script>');
		WriteLine('<script type="text/javascript">try{Typekit.load();}catch(e){}</script>');
	HEAD_End();
	BODY_Begin(array('style'=>'visibility:hidden'), 'onLoad="LoadBody()"');
		include(DOCUMENT_ROOT.'/sample/nav.php');
		DIV_Begin(array('class'=>'container-fluid', 'id'=>'content'));
			//include(DOCUMENT_ROOT.'/read.php');
			$year = '2011-'.date("Y");
			include(DOCUMENT_ROOT.'/sample.php');
		DIV_End();
		SCRIPT_Begin();
			WriteLine('
				var page = "'.$page.'";
				function LoadBody()
				{
					if (window.location.hash) {
						var element = document.getElementByID(window.location.hash);
						scrollTo(element.clientLeft, element.clientTop);
					}
					if(document.getElementById("content").style.minHeight < screen.height)
						document.getElementById("content").style.height = screen.height;
					document.body.style.visibility = visible;
				}
			');
		SCRIPT_End();
	BODY_End();
	HTML_End();
?>