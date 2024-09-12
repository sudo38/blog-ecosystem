<?php
   $paginate = pagination('categories', 2);
   $categories = $paginate['records'];
   $links = $paginate['render'];
   
   view('dash.category.index', array(
      'categories' => $categories,
      'links' => $links
   ));

