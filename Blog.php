<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Blog_model;
class Blog extends Controller
{
 public function index()
 {
 	$baseLab4 = Blog_model::get_posts();
 	$data= array(
 	'MENU_1' => "Home",
 	'href1' => 'blog',
 	'MENU_2' => 'Login',
 	'href2' => 'login', 
 	'MENU_3' => 'Register',
 	'href3' => 'register',
 	'userId' => 'no',
 	'baseLab4' => $baseLab4);

 	if(isset($_SESSION['id'])){
 
    $name = $this->session->userdata['session_id']['name'];

    $data= array(
    'MENU_1' => "Home",
 	'href1' => 'blog',
 	'MENU_2' => 'Welcome '.$name,
 	'href2' => '#', 
 	'MENU_3' => 'Logout',
 	'href3' => 'logout',
 	'MENU_4' => 'Post Blog',
 	'href4' => 'post');
	$data['post.id'] = $data[ 'posts'][0]['id'];
    $data['blog'] = $this->Blog_model->get_posts();
	$data['session_id'] = $_SESSION['id'];
            
    return view('index_template', $data);
        }
    return view("index_template", $data);
 }

  public function register()
 {
 	$data= array(
 	'MENU_1' => "Home",
 	'href1' => 'blog',
 	'MENU_2' => 'Login',
 	'href2' => 'blog/login', 
 	'MENU_3' => 'Register',
 	'href3' => 'blog/register',
	 'username' => '',
	 'email' => '',
	 'MessageError' => -1
 	);

 	return view("register_template" ,$data);

 }


}
?>