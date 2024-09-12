<?php
   $category = get_items('categories', 'id', request('id'));

   if(!$category){
      redirect(aurl('categories'));
   }

   $name_err = input_err('name');
   $desc_err = input_err('description');

   view('admin.category.edit', array(
      'category' => $category,
      'name_err' => $name_err,
      'desc_err' => $desc_err
   ));
