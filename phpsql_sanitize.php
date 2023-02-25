

<?php

function query_is_safe($query_str)
{
	if(str_contains($query_str,'--')){
	return false;
	}
	if(str_contains($query_str,'#')){
	return false;
	}
//	if(str_contains($query_str,'/'.'*')){
//	return false;
//	}
//	if(str_contains($query_str,"*".'/')){
//	return false;
//	}
	if(str_contains($query_str,"*")){
	return false;
	}
	return true;
}

?>
