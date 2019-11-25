<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Blog_model;
use Illuminate\Support\Facades\Cookie;
class Blog extends Controller
{
 public function index() {
    self::verifyCookie('remember_digest');
 	$baseLab4 = Blog_model::get_posts();
 	$data= array(
     	'MENU_1' => "Home",
     	'href1' => '/~a58604/LAB9_10/blog',
     	'MENU_2' => 'Login',
     	'href2' => '/~a58604/LAB9_10/blog/login', 
     	'MENU_3' => 'Register',
     	'href3' => '/~a58604/LAB9_10/blog/register',
     	'userId' => 'no',
 	    'baseLab4' => $baseLab4
    );

    if (session()->has('name')) {
    $name=session()->get('name');
    $id=session()->get('id');
    $data2= array(
        'MENU_1' => "Home",
        'href1' => '/~a58604/LAB9_10/blog',
        'MENU_2' => 'Welcome '.$name,
        'href2' => '', 
        'MENU_3' => 'Logout',
        'href3' => '/~a58604/LAB9_10/blog/logout',
        'MENU_4' => 'Post Blog',
        'href4' => '/~a58604/LAB9_10/blog/post',
        'userId' => $id,
        'baseLab4' => $baseLab4
    );
    return view('index_template', $data2);
    }   
    return view("index_template", $data);
 }

  public function register() {
    if(self::verifyCookie('remember_digest') == true) {
        return redirect("/blog");
    }    
 	$data= array(
     	'MENU_1' => "Home",
     	'href1' => '/~a58604/LAB9_10/blog',
     	'MENU_2' => 'Login',
     	'href2' => '/~a58604/LAB9_10/blog/login', 
     	'MENU_3' => 'Register',
     	'href3' => '/~a58604/LAB9_10/blog/register',
    	'username' => '',
    	'email' => '',
    	'MessageError' => -1
    );

    return view('register_template', $data);
    }


   public function register_action(Request $request) {
    $username  = $request->username;
    $email    = $request->email;
    $password   = $request->password;
    $password_confirmed= $request->passwordconfirmed;
    $password_final= substr(md5($password),0,32);

    $nrows= Blog_model::check_email($email);

    if ($password!=$password_confirmed && empty($username)!=true && empty($email)!=true)
        return redirect('blog/register')->withErrors('Passwords não coincidem')->withInput();
    elseif (empty($password) && empty($password_confirmed) && empty($username)!=true && empty($email)!=true)
        return redirect('blog/register')->withErrors('Password em branco')->withInput();
    elseif ( empty($password) || empty($password_confirmed) || empty($username) || empty($email))
       return redirect('blog/register')->withErrors('Todos os campos devem ser preenchidos')->withInput();
    elseif (count($nrows)>0)
        return redirect('blog/register')->withErrors('Email já existe na base de dados')->withInput($request->except('email'));
    else {
        $register= Blog_model::register_user($username,$email,$password_final);
        $data = array(
        'Message' => "Success: New user registered");
        return view('message_template',$data);
    }
 }
    public function login() {
    if(self::verifyCookie('remember_digest') == true) {
        return redirect("/blog");
    }
    $data= array(
        'MENU_1' => "Home",
        'href1' => '/~a58604/LAB9_10/blog',
        'MENU_2' => 'Login',
        'href2' => '/~a58604/LAB9_10/blog/login', 
        'MENU_3' => 'Register',
        'href3' => '/~a58604/LAB9_10/blog/register',
        'username' => '',
        'email' => '',
        'MessageError' => -1
    );
    return view('login_template', $data);
    }
    private function create_cookie($email){
        $value = substr(md5(time()),0,32);
        Cookie::queue('remember_digest',$value, ((3600 * 24 * 30)));
        Blog_model::set_cookie($email,$value);
    }
    public function login_action(Request $request)
    {
        $email    = $request->email;
        $password   = $request->password;
        $password_final= substr(md5($password),0,32);

        $nrowslogin= Blog_model::validate_user($email,$password_final);

        if (count($nrowslogin) >0) {
            session(['id' => $nrowslogin[0]->id]);
            session(['name' => $nrowslogin[0]->name]);
            $data = array(
            'Message' => "Welcome back!");
            if($request->rememberMe == true)
                self::create_cookie($email);
            return view('message_template',$data);
        }
        else
            return redirect('blog/login')->withErrors('Login failed');
    } 

    public function logout(){
    session()->flush();
    $baseLab4 = Blog_model::get_posts();
    $data= array(
        'MENU_1' => "Home",
        'href1' => '/~a58604/LAB9_10/blog',
        'MENU_2' => 'Login',
        'href2' => '/~a58604/LAB9_10/blog/login', 
        'MENU_3' => 'Register',
        'href3' => '/~a58604/LAB9_10/blog/register',
        'userId' => 'no',
        'baseLab4' => $baseLab4,
        'Message' => 'See you back soon'
    );
    Cookie::queue('remember_digest','', -1);
    return view('message_template', $data);
    }

    public function post($blog_id = FALSE){
          if(!session()->has('id')) {

        $data = array(
            'Message' => 'Login First'
        );
            return view('message_template', $data);
        }

        $user_id=session()->get('id');
        
        $nrows=Blog_model::get_blog($blog_id,$user_id);   

        $data= array(
            'MENU_1' => "Home",
            'href1' => '/~a58604/LAB9_10/blog',
            'blog_id'=> '',
            'post' => ''
        );
           

        if(!empty($blog_id)){
           // print_r($nrows);
            $data['post'] = $nrows[0]->content;
            $data['blog_id']= $blog_id;
        }
        return view('blog_template',$data);
    }

    public function post_action(Request $request, $blog_id = FALSE)
    {
        $user_id=session()->get('id');
        $nrows=Blog_model::get_blog($blog_id,$user_id);
        $content=$request->post;
        if(count($nrows)>0){
           Blog_model::update_blog($content,$blog_id,$user_id);
            $data = array(
            'Message' => 'SUCCESS: Post updated'
            );
            return view('message_template',$data);
        }
        else{ 
            Blog_model::new_blog($content,$user_id);
            $data= array(
                'Message' => 'SUCCESS: New post submitted!'
            );        
            return view('message_template',$data);
        }
    }

    private function verifyCookie($name){
        if(Cookie::has($name) == 1) {
            $value = Cookie::get($name);
            $nrows = Blog_model::get_user_cookie($value);
            if(count($nrows)>0){
                session(['id' => $nrows[0]->id]);
                session(['name' => $nrows[0]->name]);
                return true;
            }
        }
        return false;
    }
}
?>