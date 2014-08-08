<?php
//  Example smarty helper
// Used in views/demo/getuser.html

function smarty_modifier_lower($str){
	return strtolower($str);
}
?>