<?php

  // is_blank('abcd')
  function is_blank($value='') {
    // TODO
    if(strlen($value)==0){
      return true;
    }else{
      return false;
    }
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    // TODO
    $min=$options["min"];
    $max=$options["max"];
    $length=strlen($value);
    if($length>=$min && $length<=$max){
      return true;
    }else{
      return false;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    // TODO
  }

?>
