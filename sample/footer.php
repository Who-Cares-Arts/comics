<?php
NAV_Begin(array("class"=>""));
DIV_Begin(array("class"=>"container-fluid"));
DIV_Begin(array("class"=>"navbar-header"));
P_Begin(array("class"=>"navbar-text"));
WriteLine("Copyright &copy; $year Who Cares? Arts.  Copyright &copy . All rights reserved.");
P_End();
DIV_End();
DIV_Begin();
UL_Begin(array("class"=>"nav navbar-nav"));
PrintNavElement_Home("about", "About");
PrintNavElement_Home("contactus", "Contact Us", TRUE);
UL_End();
DIV_End();
NAV_End();
?>
