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

  function form_errors($errors=array()){
    $output = null;

    if(!empty($errors)){
      $output = "Please fix the following:";
      $output .= "<ul>";
      foreach ($errors as $field => $error) {
        $output .= "<li>{$error}</li>";
      }
      $output .= "</li>";
    }

    echo $output;
  }

?>
