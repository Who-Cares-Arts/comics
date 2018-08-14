<?php
	function CreateComicNavigation($baseUrl, $hasCover = NULL, $hasEnd = NULL)
	{
		$max = $GLOBALS['max']; $min = $GLOBALS['min']; $pValue = $GLOBALS['pValue']; $nValue = $GLOBALS['nValue']; $value = $GLOBALS['value'];
		$first = ''; $last = '';
		if ($value == $min || $value == "cover"){
			$first = 'disabled';
            if(!is_null($hasCover))
                $value = "cover";
        }
		if ($value == $max || $value == "end"){
			$last = 'disabled';
            if(!is_null($hasEnd))
                $value = "end";
        }

		NAV_Begin();
			UL_Begin(array('class'=>'pager'));
				LI_Begin(array('class'=>$first));
					if ($hasCover != NULL)
						A_Begin(array('href'=>$baseUrl.'/cover'), 'aria-label="Previous"');
					else
						A_Begin(array('href'=>$baseUrl.'/'.$min), 'aria-label="Previous"');
						SPAN_Begin(array(), 'aria-hidden="true"');
							WriteLine('&laquo;');
						SPAN_End();
					A_End();
				LI_End();
				LI_Begin(array('class'=>$first));
					A_Begin(array('href'=>$baseUrl.'/'.$pValue));
						WriteLine('Prev');
					A_End();
				LI_End();
				DIV_Begin(array('class'=>'btn-group'));
					BUTTON_Begin(array('type'=>'button', 'class'=>'btn btn-default dropdown-toggle'), 'data-toggle="dropdown" aria-expanded="false"');
						A_Begin(array('href'=>'#'));
	    						WriteLine('Page: '.$value);
	    						SPAN_Begin(array('class'=>'caret'));
		    						SPAN_End();
	    					A_End();
	    				BUTTON_End();
					UL_Begin(array('class'=>'dropdown-menu'), 'role="menu"');
						if ($hasCover != NULL)
						{
							LI_Begin();
								A_Begin(array('href'=>$baseUrl.'/cover'));
									WriteLine('COVER');
								A_End();
							LI_End();
						}
						for($i = $min; $i <= $max; $i++)
						{
                            if(($hasEnd && $i == $max) || ($hasCover && $i == 0))
                                continue;
							LI_Begin();
								A_Begin(array('href'=>$baseUrl.'/'.$i));
									WriteLine($i);
								A_End();
							LI_End();
						}
						if ($hasEnd != NULL)
						{
							LI_Begin();
								A_Begin(array('href'=>$baseUrl.'/end'));
									WriteLine('END');
								A_End();
							LI_End();
						}
		    			UL_End();
		    		DIV_End();
				LI_Begin(array('class'=>$last));
					A_Begin(array('href'=>$baseUrl.'/'.$nValue));
						WriteLine('Next');
					A_End();
				LI_End();
				LI_Begin(array('class'=>$last));
					if ($hasEnd != NULL)
						A_Begin(array('href'=>$baseUrl.'/end'), 'aria-label="Next"');
					else
						A_Begin(array('href'=>$baseUrl.'/'.$max), 'aria-label="Next"');
						SPAN_Begin(array(), 'aria-hidden="true"');
							WriteLine('&raquo;');
						SPAN_End();
					A_End();
				LI_End();
			UL_End();
		NAV_End();
	}
?>