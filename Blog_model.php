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
  public function register_user($username,$email,$password){
        
        $insert = DB::insert("INSERT INTO users(name, email, password_digest, created_at, updated_at) VALUES('$username','$email','$password_final',NOW(),NOW())");
        
        return $insert;
    }
    public static function check_email($email){
        $email="SELECT * FROM users where email='$email'";
        $queryemail=DB::select($email);
        return $queryemail;
    }
    
}
 ?>