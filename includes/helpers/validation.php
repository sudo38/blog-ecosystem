<?php

$validations = [];

if (!function_exists('validator')){
   function validator($attributes, $trans=[], $http_header='redirect', $back=null){
      global $validations;

      foreach ($attributes as $attribute => $rules) {
         $value = request($attribute);
         $finalAttr = $trans ? $trans[$attribute] : $value;
         $values[$attribute] = $value;
         $validateAttrs = [];
   
         foreach(explode('|', $rules) as $rule){
            if ($rule == 'required' && (is_null($value) || empty($value) || (is_array($value) && empty($value['name'])))){
               $validateAttrs = str_replace(':attr:', $finalAttr, trans('validation.required'));
               break;
            }
            elseif (preg_match('/^unique/i', $rule)){
               $ruleArray = explode(':', $rule);
               if (count($ruleArray) > 1){
                  $getUniqueInfo = explode(',', $ruleArray[1]);

                  $table = $getUniqueInfo[0];
                  $key = $attribute;

                  if(count($getUniqueInfo) > 1){
                     $id = $getUniqueInfo[1];
                     $checkUniqueDb = exclude_item($table, $key, $value, $id);
                  }else {
                     $checkUniqueDb = get_items($table, $key, $value);
                  }

                  if ($checkUniqueDb){
                     $validateAttrs = str_replace(':attr:', $finalAttr, trans('validation.unique'));
                  }
               }
            }
            elseif (preg_match('/^in/i', $rule)){
               $ruleArray = explode(':', $rule);

               if (isset($ruleArray[1])){
                  $ruleIn = explode(',', $ruleArray[1]);
                  if (is_array($ruleIn) && !in_array($value, $ruleIn)){
                     $validateAttrs = str_replace(':attr:', $finalAttr, trans('validation.in'));
                  }
               }
               
            }
            elseif (preg_match('/^equal/i', $rule)){
               $ruleArray = explode(':', $rule);

               if($value !== request($ruleArray[1])){
                  $validateAttrs = str_replace(':attr:', $finalAttr, trans('validation.equal'));
               }
               
            }
            elseif ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)){
               $validateAttrs = str_replace(':attr:', $finalAttr, trans('validation.email'));
            }
            elseif ($rule == 'integer' && !filter_var($value, FILTER_VALIDATE_INT)){
               $validateAttrs = str_replace(':attr:', $finalAttr, trans('validation.integer'));
            }
            elseif ($rule == 'numeric' && !filter_var($value, FILTER_VALIDATE_FLOAT)){
               $validateAttrs = str_replace(':attr:', $finalAttr, trans('validation.numeric'));
            }
            elseif ($rule == 'image' && !empty($value['tmp_name']) && getimagesize($value['tmp_name']) == false){
               $validateAttrs = str_replace(':attr:', $finalAttr['name'], trans('validation.image'));
            }
         }
         if ($validateAttrs){
            $validations[$attribute] = $validateAttrs;
         }
      }
      
      if (count($validations)){
         if ($http_header == 'redirect'){
            session('validations', json_encode($validations));
            session('old', json_encode($values));
            if ($back){
               redirect($back);
            } else {
               back();
            }
         } elseif ($http_header == 'api'){
            return json_encode($validations, JSON_UNESCAPED_UNICODE);
         }
      } else {
         return $values;
      }
   }
}


if (!function_exists('input_err')){
   function input_err($offset=null){
      $array = json_decode(session('validations'), true);

      if ($offset !== null && isset($array[$offset])){
         $error = $array[$offset];
         unset($array[$offset]);
         session_forget('validations');
         session('validations', json_encode($array));
         return $error;
      }
      // elseif ($offset === null && count($array)){
      //    return $array;
      // }
   }
}


if (!function_exists('old')){
   function old($offset){
      $old_values = json_decode(session('old'), true);

      if (is_array($old_values) && in_array($offset, array_keys($old_values))){
         return $old_values[$offset];
      }
   }
}