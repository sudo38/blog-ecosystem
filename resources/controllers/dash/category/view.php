<?php
   $category = get_items('categories', 'id', request('id'));

   if(!$category){
      redirect(aurl('categories'));
   }

   view('admin.category.view', array(
      'category' => $category,
   ));