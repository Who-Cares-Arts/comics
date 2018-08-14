<?php
        if($page == "read")
		    NAV_Begin(array('class'=>'navbar navbar-default'));
        else {
            DIV_Begin(array('style'=>'height:50px;'));
            DIV_End();
		    NAV_Begin(array('class'=>'navbar navbar-default navbar-fixed-top')); 
        }

			DIV_Begin(array('class'=>'container-fluid'));
				DIV_Begin(array('class'=>'navbar-header'));
					BUTTON_Begin(array('class'=>'navbar-toggle collapsed'), 'data-toggle="collapse" data-target="#navbar-home"');
					SPAN_Begin(array('class'=>'sr-only'));
						WriteLine('Toggle navigation');
					SPAN_End();
					SPAN_Begin(array('class'=>'icon-bar'));
					SPAN_End();
					SPAN_Begin(array('class'=>'icon-bar'));
					SPAN_End();
					SPAN_Begin(array('class'=>'icon-bar'));
					SPAN_End();
					BUTTON_END();
					A_Begin(array('href'=>'http://art.whocaresarts.com', 'class'=>'navbar-brand'));
						IMG_Begin(array('src'=>img_logo("web", TRUE)), '');
					A_End();
				DIV_End();
				DIV_Begin(array('class'=>'collapse navbar-collapse', 'id'=>'navbar-home'));
					UL_Begin(array('class'=>'nav navbar-nav'));
						LI_Begin(array('class'=>'dropdown'), 'role="presentation"');
							A_Begin(array('class'=>'dropdown-toggle', 'href'=>'http://art.whocaresarts.com'), 'data-toggle="dropdown" aria-expanded="false" role="button"');
								WriteLine('Home');
								SPAN_Begin(array('class'=>'caret'));
								SPAN_End();
							A_End();
							UL_Begin(array('class'=>'dropdown-menu'), 'role="menu"');
								PrintNavElement_Home('home', 'Home');
								PrintNavElement_Home('viewcontent', 'View Content');
								if(GUEST == FALSE)
									PrintNavElement_Home('mycontent', 'My Content');
								PrintNavElement_Home('socialmediabuzz', 'Social Media Buzz');
							UL_End();
						LI_End();
						PrintNavElement_Home('news', 'News');
						PrintNavElement_Home('characters', 'Characters');
						PrintNavElement_Home('comics', 'Comics');
						//PrintNavElement_Home('home', 'Home');
						//PrintNavElement_Home('games', 'Games');
						//PrintNavElement_Home('animation', 'Animations');
						//PrintNavElement_Home('forums', 'Forums', TRUE);
						include(DOCUMENT_ROOT."$siteType/$site/nav.php");
					UL_End();
      				UL_Begin(array("class"=>"nav navbar-nav navbar-right"));
						//include(DOCUMENT_ROOT."/loginDisqus.php");
					UL_End();
				DIV_End();
			DIV_End();
			if (file_exists(DOCUMENT_ROOT.'/sites/'.$site.'/error.php'))
				include(DOCUMENT_ROOT.'/sites/'.$site.'/error.php');
			else if (file_exists(DOCUMENT_ROOT.'/sites/home/'.$page.'/error.php'))
				include(DOCUMENT_ROOT.'/sites/home/'.$page.'/error.php');
			else
				include(DOCUMENT_ROOT.'/error.php');
		NAV_End();
?>