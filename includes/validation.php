<?php

  $errors = array();

  function fieldname_as_text($fieldname){
    $fieldname = str_replace("_", " ", $fieldname);
    $fieldname = ucfirst($fieldname);
    return $fieldname;
  }

  function has_presence($value){
    return isset($value) && trim($value) !== "";
  }

  function validate_presences($required_fields){
    // expects a numericaly indexed array with fields names that match what is expected from POST superglobal
    global $errors;
    foreach ($required_fields as $field) {
      $value = trim($_POST[$field]);
      if(!has_presence($value)){
        $errors[$field] = fieldname_as_text($field) . " can't be left blank";
      }
    }
  }

  function max_length_or_under($value, $max){
    // true if length of string is less than max
    return strlen($value) <= $max;
  }

  function validate_max_lengths($field_length_array){
    // expects assoc array -> [field: max length allowed]
    // note field must correspond to the name expected of the values found in the $_POST superglobal
    global $errors;
    foreach ($field_length_array as $field => $max) {
      $value = trim($_POST[$field]);
      if (!max_length_or_under($value, $max)) {
        $errors[$field] = fieldname_as_text($field) . " is too long";
      }
    }
  }

  function included_in($value, $set){
    return in_array($value, $set);
  }

  function larger_than_or_equal_to($value, $min){
    return strlen($value) >= $min;
  }

  function validate_min_lengths($field_length_array){
    // EXPECTS assoc array -> [field: min length allowed]
    // NOTICE field must correspond to the name expected of the values found in the $_POST superglobal
    global $errors;
    foreach ($field_length_array as $field => $min) {
      $value = trim($_POST[$field]);
      if (!larger_than_or_equal_to($value, $min)) {
        $errors[$field] = fieldname_as_text($field) . " is too short";
      }
    }
  }

?>
