<?php
function limpiarInput($input)
{
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}