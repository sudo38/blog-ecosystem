<?php


/**
 * Insert data in database
 * @param string $table
 * @param array $params
 * @return bool
 */

if (!function_exists('create_item')){
   function create_item($table, $params){
      global $database;
      $keys = "";
      $values = "";
      
      foreach(array_keys($params) as $param){
         $keys .= "$param, ";
         $values .= ":$param, ";
      }

      $keys = rtrim($keys, ', ');
      $values = rtrim($values, ', ');
      $rowsQuery = $database->prepare("INSERT INTO $table($keys) VALUES($values)");

      foreach($params as $param => $arg){
         $rowsQuery->bindValue($param, $arg);
      }

      return [
         'created' => $rowsQuery->execute(),
         'row_id' => $database->lastInsertId(),
      ];
   }
}


/**
 * Update data in database
 * @param string $table
 * @param array $params
 * @param string $cond
 * @param string $special
 * @return bool
 */

if (!function_exists('update_item')){
   function update_item(string $table, array $params, string $cond, string $special=null):bool{
      global $database;
      $query = "";
      
      foreach(array_keys($params) as $param){
         if($param != $special){
            $query .= $param." = :$param, ";
         }
      }
      
      $query = rtrim($query, ', ');
      $rowsQuery = $database->prepare("UPDATE $table SET $query WHERE $cond");

      foreach($params as $param => $arg){
         $rowsQuery->bindValue($param, $arg);
      }

      return $rowsQuery->execute();
   }
}

/**
 * Delete data in database
 * @param string $table
 * @param string $key
 * @param string $value
 * @return bool
 */

if (!function_exists('delete_item')){
   function delete_item(string $table, string $key, string $value):bool{
      global $database;
   
      $rowsQuery = $database->prepare("DELETE FROM $table WHERE $key = :value");
      $rowsQuery->bindParam('value', $value);
      return $rowsQuery->execute();
   }
}


/**
 * Get data in database
 * @param string $table
 * @param string $key
 * @param string $value
 * @param string $cols
 * @return mixed
 */

if (!function_exists('exclude_item')){
   function exclude_item($table, $key, $value, $id){
      global $database;

      $rows_query = $database->prepare("SELECT * FROM $table WHERE $key = :value AND id != :id");
      $rows_query->bindParam('value', $value);
      $rows_query->bindParam('id', $id);
      $rows_query->execute();

      if ($rows_query->rowCount() == 1){
         return $rows_query->fetchObject();
      }
   }
}


if (!function_exists('get_items')){
   function get_items($table, $key=null, $value=null, $limit=100, $cols="*"){
      global $database;
   
      if($key){
         $cond = " WHERE $key = :value";
      } else {
         $cond = "";
      }

      $rows_query = $database->prepare("SELECT $cols FROM $table".$cond." LIMIT ".$limit);

      if($value){
         $rows_query->bindParam('value', $value);
      }

      $rows_query->execute();
      $rows_count = $rows_query->rowCount();

      if ($rows_count == 1){
         return $rows_query->fetchObject();
      } elseif ($rows_count > 1){
         return $rows_query->fetchAll();
      }
   }
}


if (!function_exists('fetch_with_date')){
   function fetch_with_date($table, $col, $month){
      global $database;

      if(!in_array($month, ['01', '02', '03', '04', '05', '06'])){
         clear_url();
      }

      $rows_query = $database->prepare("SELECT * FROM $table WHERE ".$col." BETWEEN :start AND :end");

      $first = '01';
      $last = '';
      $year = date('Y');

      if($month == '06'){
         $last = '30';
      } elseif($month == '05'){
         $last = '31';
      } elseif($month == '04'){
         $last = '30';
      } elseif($month == '03'){
         $last = '31';
      } elseif($month == '02'){
         $last = '28';
      } elseif($month == '01'){
         $last = '31';
      }

      $start = $year.'-'.$month.'-'.$first;
      $end = $year.'-'.$month.'-'.$last;

      $rows_query->bindParam('start', $start);
      $rows_query->bindParam('end', $end);

      $rows_query->execute();
      $rows_count = $rows_query->rowCount();

      if ($rows_count == 1){
         return $rows_query->fetchObject();
      } elseif ($rows_count > 1){
         return $rows_query->fetchAll();
      }
   }
}

if (!function_exists('many_to_many')){
   function many_to_many($cols, $from, $to, $str){
//       global $database;

//       $rows_query = $database->prepare("SELECT $cols FROM $from ".$join_str);
//       $stmt = $database->query("
//       SELECT posts.id, posts.title, GROUP_CONCAT(tags.name SEPARATOR ', ') AS tags
//       FROM posts
//       JOIN post_tag ON posts.id = post_tag.post_id
//       JOIN tags ON post_tag.tag_id = tags.id
//       GROUP BY posts.id, posts.title
// ");

   }
}

if (!function_exists('fetch_items')){
   function fetch_items($table, $cols, $join_str, $cond_args=[], $key=null, $value=null){
      global $database;
      
      $cond = '';
      if($cond_args){
         $cond = ' WHERE ';
         foreach($cond_args as $i => $arg){
            $cond .= $table.'.id = :value_'.$i.' OR ';
         }
         $cond = rtrim($cond, ' OR ');
      } elseif($key && $value){
         $cond = ' WHERE '.$key.' = :value';
      }

      $rows_query = $database->prepare("SELECT $cols FROM $table ".$join_str.$cond);
      if($cond_args){
         foreach($cond_args as $i => $arg){
            $rows_query->bindValue('value_'.$i, $arg);
         }
      } elseif($key && $value){
         $rows_query->bindParam('value', $value);
      }
      
      $rows_query->execute();
      return $rows_query->fetchAll();
   }
}


/**
 * Search data in database
 * @param string $table
 * @param string $key
 * @param string $value
 * @param string $cols
 * @return mixed
 */

if (!function_exists('search_items')){
   function search_items(string $table, string $key, string $value, string $cols="*"):mixed{
      global $database;
   
      $value = "%$value%";
      $rowsQuery = $database->prepare("SELECT $cols FROM $table WHERE $key LIKE :value");
      $rowsQuery->bindParam("value", $value);
      $rowsQuery->execute();
      return $rowsQuery;
   }
}




/**
 * Pagination on show the data
 * @param string $table
 * @param string $key
 * @param string $value
 * @param int $limit
 * @param string $cols
 * @return array
 */

if (!function_exists('pagination')){
   function pagination($tableOrArray, $limit, $cols="*"){
      global $database;

      if (isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p'] > 0){
         $currentPage = $_GET['p'] - 1;
      } else {
         $currentPage = 0;
      }

      if( is_array($tableOrArray)){
         $start = $currentPage * $limit;
         $totalRecords = count($tableOrArray);
         $totalPages = ceil($totalRecords / $limit);
         $pagedData = array_slice($tableOrArray, $start, $limit);
      } else {
         $start = $currentPage * $limit;
         $totalRecordsQuery = $database->prepare("SELECT $cols FROM $tableOrArray");
         $totalRecordsQuery->execute();
         $totalRecords = $totalRecordsQuery->rowCount();
         $totalPages = ceil($totalRecords / $limit);

         $rowsQuery = $database->prepare("SELECT $cols FROM $tableOrArray LIMIT {$start}, {$limit}");
         $rowsQuery->execute();
      }

      if ($currentPage >= $totalPages){
         $start = $totalPages + 1;
      }
      
      return [
         'records' => is_array($tableOrArray) ? $pagedData : $rowsQuery->fetchAll(),
         'currentPage' => $totalPages,
         'totalPages' => $totalPages,
         'render' => render_paginate($totalPages),
      ];
   }
}


/**
 * Render paginate on show the data
 * @param int $totalPages
 * @return string
 */

 if (!function_exists('render_paginate')){
   function render_paginate(int $totalPages):string{
      if (request('p') <= 0 ){
         $requestPage = 1;
      } elseif (request('p') > $totalPages ){
         $requestPage = $totalPages;
      } else {
         $requestPage = request('p');
      }
      // var_dump($_REQUEST);
      // echo count($_REQUEST);

      if(count($_REQUEST) == 1){
         $link = url($_SERVER['REQUEST_URI']).'&p=';
      } else {
         $link = url($_SERVER['REQUEST_URI']).'?p=';
      }

      $currentPage = $requestPage >= $totalPages ? $totalPages : $requestPage;
      $previous_disabled = (empty(request('p')) || $currentPage == 1) ? 'disabled' : '';
      $previous_page = !empty(request('p'))  ? $requestPage-1 : $totalPages;
      $html = '<nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
                     <li class="page-item">
                        <a class="page-link '.$previous_disabled.'" href="'.$link.$previous_page.'" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                     </li>';

      for ($i=1; $i <= $totalPages; $i++) {
         $active = $currentPage == $i ? 'active' : '';
         $html .= "<li class='page-item'>
                     <a class='page-link ".$active."' href='?p=$i'>$i</a>
                  </li>";
      }

      if(count($_REQUEST) == 1){
         $link = url($_SERVER['REQUEST_URI']).'&p=';
      } else {
         $link = url($_SERVER['REQUEST_URI']).'?p=';
      }

      $next_disabled = (!empty(request('p')) && $currentPage == $totalPages) ? 'disabled' : '';
      $next_page = !empty(request('p')) ? $requestPage+1 : 1;

      $html .= '      <li class="page-item">
                        <a class="page-link '.$next_disabled.'" href="'.$link.$next_page.'" aria-label="Next">
                           <span aria-hidden="true">&raquo;</span>
                        </a>
                     </li>
                  </ul>
               </nav>';
      return $html;
   }
}
