<?php
namespace App;
use Illuminate\Support\Facades\DB;
class Blog_model
{
 public static function get_posts()
 {
 	$sql = DB::select("SELECT name,microposts.created_at,microposts.updated_at,microposts.user_id,microposts.id,content FROM users INNER JOIN microposts ON users.id = microposts.user_id ORDER BY microposts.updated_at DESC");
    return $sql;
 }
  public static function register_user($username,$email,$password_final){
        
        $insert = DB::insert("INSERT INTO users(name, email, password_digest, created_at, updated_at) VALUES('$username','$email','$password_final',NOW(),NOW())");
        
        return $insert;
    }
    public static function check_email($email){
        $queryemail= DB::select("SELECT * FROM users where email='$email'");
        return $queryemail;
    }
    public static function validate_user($email,$password_final){
              
        $queryvalidate = DB::select("SELECT * FROM users WHERE email='$email' AND password_digest='$password_final'");
        return $queryvalidate;
    }

    public static function new_blog($post, $userid){
        
        $insertpost = DB::insert("INSERT INTO microposts (content, user_id, created_at, updated_at) VALUES ('$post', '$userid', NOW(), NOW())");
        return $insertpost;
    }

     public static function get_blog($blog_id, $user_id){
        $getblog = DB::select("SELECT content FROM microposts WHERE user_id ='$user_id' AND id='$blog_id'");
        return $getblog;
    }
    
    public static function update_blog($post,$blog_id, $user_id){
       
        $udpateblog = DB::update("UPDATE microposts SET content='$post', updated_at=NOW() WHERE user_id='$user_id' AND id='$blog_id'");
        
        return $udpateblog;
    }
    public static function set_cookie($email,$value) {
        DB::update("UPDATE users SET remember_digest = '$value' WHERE email='$email'");
    }
    public static function get_user_cookie($value){
        $query = DB::select("SELECT * FROM users WHERE remember_digest='$value'");
        return $query;        
    }
}
 ?>