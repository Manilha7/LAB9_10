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


    return view("index_template", $data);
 }

  public function register()
 {
 	$data= array(
 	'MENU_1' => "Home",
 	'href1' => '/',
 	'MENU_2' => 'Login',
 	'href2' => '/login', 
 	'MENU_3' => 'Register',
 	'href3' => '/register',
	 'username' => '',
	 'email' => '',
	 'MessageError' => -1
    );

    return view('register_template', $data);
    }
   public function register_action(Request $request)
 {
    $username  = $request->username;
    $email    = $request->email;
    $password   = $request->password;
    $password_confirmed= $request->passwordconfirmed;
    $password_final= substr(md5($password),0,32);

    $nrows= Blog_model::check_email($email);

    if ($password!=$password_confirmed && empty($username)!=true && empty($email)!=true) {
        return redirect('register')->withErrors('Passwords não coincidem');
    }
    elseif (empty($password) && empty($password_confirmed) && empty($username)!=true && empty($email)!=true) {
        return redirect('register')->withErrors('Password em branco');
    }
    elseif ( empty($password) || empty($password_confirmed) || empty($username) || empty($email)) {
       return redirect('register')->withErrors('Todos os campos devem ser preenchidos');
    }

    elseif (count($nrows)>0) {
        return redirect('register')->withErrors('Email já existe na base de dados');
    }
    else{
        $Message='Success: New user registered';
        return view('/message_template', $Message);
        }

 }

}
?>