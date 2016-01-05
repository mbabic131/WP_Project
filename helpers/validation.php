<?php

//validate user input
function validate_user($string, $type, $length){

  // assign the type
  $type = 'is_'.$type;

  if(!$type($string))
    {
    return FALSE;
    }
  // check if the field is empty
  elseif(empty($string))
    {
    return FALSE;
    }
  // check the length of the string
  elseif(strlen($string) < $length)
    {
    return FALSE;
    }
  else
    {
    // if all is well, return TRUE
    return TRUE;
    }
}

function validate_input($input, $min, $max) {

	//check input type
	if(!is_numeric($input)) {

		return FALSE;
	}

	//check if the input is 0 or less then 0
	elseif($input <= 0) {

		return FALSE;
	}

	//check if the field is empty
	elseif(empty($input)) {

		return FALSE;
	}

	//check if the input is in order with min and max values
	elseif(strlen($input) < $min && strlen($input) > $max) {

		return FALSE;
	}

	else {

		return TRUE;
	}
}

?>