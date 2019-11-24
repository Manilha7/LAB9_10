<?php
namespace App;
use Illuminate\Support\Facades\DB;
class Blog_model
{
 public static function get_posts()
 {
 	$sql = DB::select("SELECT name,microposts.created_at,microposts.updated_at,microposts.user_id,content FROM users INNER JOIN microposts ON users.id = microposts.user_id ORDER BY microposts.updated_at DESC");
    return $sql;
 } 
}
 ?>