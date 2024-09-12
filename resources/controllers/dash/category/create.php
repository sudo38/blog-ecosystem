<?php
   $name = input_err('name');
   $desc = input_err('description');

   view('dash.category.create', array(
      'name' => $name,
      'desc' => $desc
   ));