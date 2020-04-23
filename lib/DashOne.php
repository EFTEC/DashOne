<?php /** @noinspection CryptographicallySecureRandomnessInspection */
/** @noinspection UnknownInspectionInspection */
/** @noinspection PhpUnused */
/** @noinspection JSUnresolvedFunction */

/** @noinspection HtmlUnknownAttribute */

namespace eftec\DashOne;
use eftec\DashOne\controls\AlertOne;
use eftec\DashOne\controls\ButtonOne;
use eftec\DashOne\controls\ContainerOne;
use eftec\DashOne\controls\FormOne;
use eftec\DashOne\controls\ImageOne;
use eftec\DashOne\controls\LinkOne;
use eftec\DashOne\controls\TableOne;
use eftec\DashOne\controls\UlOne;
use Exception;

/**
 * Class DashOne
 * @package eftec\DashOne
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 1.7 2020-04-23
 * @link https://github.com/EFTEC/DashOne
 */
class DashOne {
    const VERSION='1.6.2';

    private $html=[];
    public $hasSideMenu=false;
    private $hasPost=false;
    /** @var bool true if we want to check csrf */
    public $salt='';
    public $csrf=false;
    /**
     * In constructor, it stores the user and password.
     * @var string[] 
     */
    public $validateAccount=['user'=>'','password'=>''];
    /**
     * @var callable|null A callable function that with an argument (array) and it must returns a boolean<br>
     *                    Example:
     *                    <pre>
     *                    $validateLogin= function($user) {
     *                      if($user['username']=='john' && $user['password']=='doe') {
     *                            return true;
     *                        }
     *                        return false;
     *                    };
     *                    </pre>
     *
     */
    public $validateLogin;

    /**
     * DashOne constructor.<br>
     * <pre>
     * $obj=new DashOne(true,true,'some salt',function($userArr) { return true; });
     * $obj=new DashOne(true,true,'some salt',['user'='admin','password'='admin']);
     * </pre>
     *
     * @param bool     $hasSideMenu (default false) if true then it has a side menu
     * @param bool     $csrf (default false) if true then the forms are protected by csrf
     * @param string   $salt (optional) A salt used for autologin.
     * @param callable|array $validateLogin (optional) an anonymous function that returns if the user
     *                                (passed by argument) is true or not<br>
     *                                if is array, then it is a simple user/password
     * 
     */
    public function __construct($hasSideMenu=false,$csrf=false,$salt='',  $validateLogin=null) {
        $this->hasSideMenu = $hasSideMenu;
        $this->csrf = $csrf;
        $this->salt=$salt;
        if(is_callable($validateLogin)) {
            $this->validateLogin = $validateLogin;    
        }
        if(is_array($validateLogin)) {
            $this->validateAccount=$validateLogin;
            $this->validateLogin =  function($user) {
                $r= $user['username'] === $this->validateAccount['user'] 
                    && $user['password'] === $this->validateAccount['password'];
                if($r===false) {
                    sleep(3);
                }
                return $r;
            };
        }
        
        
    }

    public static function genNode($type='',$value=null,$class='',$id='',$messages=null) {
        return ['_def'=>$type, 'value' =>$value, 'class' =>$class, 'id' =>$id, 'messages' =>$messages];
    }

    private function css() {
        return 'body{font-size:.875rem}.bd-placeholder-img{font-size:1.125rem;text-anchor:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}@media (min-width: 768px){.bd-placeholder-img-lg{font-size:3.5rem}}.form-control-dark{color:#fff;background-color:rgba(255,255,255,.1);border-color:rgba(255,255,255,.1)}.form-control-dark:focus{border-color:transparent;
		box-shadow:0 0 0 3px rgba(255,255,255,.25)}
		.far,.fas{width:16px;height:16px;vertical-align:text-bottom}
		.leftmenu{position:fixed;top:0;bottom:0;left:0;z-index:100;padding:48px 0 0;box-shadow:inset -1px 0 0 rgba(0,0,0,.1)}
		.leftmenu-sticky{position:relative;top:0;height:calc(100vh - 48px);
		padding-top:.5rem;overflow-x:hidden;overflow-y:auto}
		.leftmenu .nav-link{font-weight:500;color:#333}
		.leftmenu .nav-link .far,
		.leftmenu .nav-link .fas{margin-right:4px;color:#999}
		.leftmenu .nav-link.active{color:#007bff}
		.leftmenu .nav-link:hover .far,
		.leftmenu .nav-link:hover .fas,
		.leftmenu .nav-link.active .far,
		.leftmenu .nav-link.active .fas{color:inherit}
		.leftmenu-heading{font-size:.75rem;text-transform:uppercase}[role="main"]{padding-top:133px}
		@media (min-width: 768px){[role="main"]{padding-top:58px}}.navbar-brand{padding-top:.75rem;padding-bottom:.75rem;font-size:1rem;background-color:rgba(0,0,0,.25);box-shadow:inset -1px 0 0 rgba(0,0,0,.25)}.navbar .form-control{padding:.75rem 1rem;border-width:0;border-radius:0}';
    }
    private function cssLogin() {
        return '.bd-placeholder-img{font-size:1.125rem;text-anchor:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}@media (min-width:768px){.bd-placeholder-img-lg{font-size:3.5rem}}body,html{height:100%}body{display:-ms-flexbox;display:flex;-ms-flex-align:center;align-items:center;padding-top:40px;padding-bottom:40px;background-color:#f5f5f5}.form-signin{width:100%;max-width:330px;padding:15px;margin:auto}.form-signin .checkbox{font-weight:400}.form-signin .form-control{position:relative;box-sizing:border-box;height:auto;padding:10px;font-size:16px}.form-signin .form-control:focus{z-index:2}.form-signin input[type=email]{margin-bottom:-1px;border-bottom-right-radius:0;border-bottom-left-radius:0}.form-signin input[type=password]{margin-bottom:10px;border-top-left-radius:0;border-top-right-radius:0}';
    }

    public function head($title='DashOne',$extraHtml='',$login=false) {
        $css=($login)? $this->cssLogin(): $this->css();

        $cin=<<<inout
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="DashOne">
            <title>$title</title>    
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
            <style>$css</style>    
            $extraHtml
        </head>
inout;
        $this->html[]=$cin;
        return $this;
    } // head

    public function footer($extraHtml='',$extraJS='') {


        $cin= "
        <script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>
        <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>
        <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\" integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\" crossorigin=\"anonymous\"></script>
        <script src='https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js'></script>
        $extraHtml</body>
        </html>
        ";
        $cin.='<script>$(document).ready(function() {$(".summernote").summernote();});</script>';
        $cin.=$extraJS;
        $this->html[]=$cin;
        return $this;
    } //footer

    /**
     * @param array       $user =['username' => '', 'password' => '', '_csrf' => '','result'=>false]
     * @param string|null $icon (optional) the icon of the login page
     * @param string      $title (optional) The title of the login page
     *
     * @return $this
     */
    public function login($user,$icon=null,$title='') {
        $icon= $icon===null ? 'https://avatars2.githubusercontent.com/u/19829219?s=400&u=ac2b98e7ad8e227baf0c7d970d18632204f52f5e&v=4'
            : $icon;
        $title= $title===null ? 'Please sign in' : $title;

        $cin='<body class="text-center">  
        <form class="form-signin" method="post">
        <input type=\'hidden\' name=\'_ispostback\' value=\'1\'/>
        <img class="mb-4" src="'.$icon.'" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">'.$title.'</h1>
        <label for="username" class="sr-only">User Name</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="User Name" value="'.$user['username'].'" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox mb-3">
        <label>
        <input type="checkbox" name="remember" checked="checked" value="remember-me"> Remember me
        </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="button" value="signin" type="submit">Sign in</button><br>';
        $this->html[]=$cin;
        $this->html[] = "<input type='hidden' name='_csrf' value='".$user['_csrf']."'/>";
        return $this;
    }
    public function endLogin() {
        $cin='</form></body></html>';
        $this->html[]=$cin;
        return $this;
    }

    /**
     * @param array $user=['username' => '', 'password' => '','remember'='', '_csrf' => false,'result'=>false];
     *
     * @return $this
     */
    public function fetchLogin(&$user) {
        if(isset($_COOKIE['user']) && !$this->isPostBack()) {
            // get the cookie
            $user=@unserialize($this->decrypt($_COOKIE['user']));
            if($user!==false) {
                if ($this->validateLogin === null) {
                    $result = true;
                } else {
                    $result = call_user_func($this->validateLogin,$user);
                }
                $user['result']=$result;
                if($result) {
                    $_SESSION['user'] = $user;
                }
                return $this;
            }
        }
        if ($this->isPostBack()) {
            $user = ['username' => '', 'password' => '','remember'=>'', '_csrf' => false,'result'=>false];
            $this->fetchValue($user, 'post');
            $result= @$_SESSION['_csrf'] === $user['_csrf'];
            if($result) {
                if ($this->validateLogin === null) {
                    $result = true;
                } else {
                    $result = call_user_func($this->validateLogin,$user);
                }
                if($result && $user['remember']) {
                    // sets cookie
                    $cookie=$this->encrypt(serialize($user));
                    @setcookie('user', $cookie, time()+31556952); // one year
                }
            }
            @$_SESSION['_csrf']=uniqid('',true);
            $user['_csrf']=$_SESSION['_csrf'];
            $user['result']=$result;
            if($result) {
                $_SESSION['user'] = $user;
            }
        } else {
            @$_SESSION['_csrf']=uniqid('',true);
            $user = ['username' => '', 'password' => '','remember'=>'', '_csrf' => $_SESSION['_csrf'],'result'=>false];
        }
        return $this;
    }

    /**
     * It gets the current user or it redirect to the login page (or returns null).<br>
     * Note: It requires a session initiated.
     *
     * @param string|null $loginPage (if null then it does not redirect but returns an null user.
     *
     * @return mixed
     */
    public static function getLogin($loginPage='login.php') {
        $user=@$_SESSION['user'];
        if(!$user || $user['result']===false) {
            if($loginPage!==null) {
                header('location:' . $loginPage);
                die(1);
            }

            $user=null;
        }
        return $user;
    }

    /**
     * It logout, deletes the session, the cookie (if any), and (optionally) returns to the login page
     *
     * @param string|null $loginPage if null then it stays in the same page.
     */
    public static function logout($loginPage='login.php') {
        $_SESSION['user']=null;
        @setcookie('user',null,1);
        @session_destroy();
        if($loginPage!==null) {
            header('location:' . $loginPage);
            die(1);
        }
    }
    /**
     * It is a two way decryption
     * @param $data
     * @return bool|string
     */
    public function decrypt($data)
    {
        $data=base64_decode(str_replace(array('-', '_'),array('+', '/'),$data));
        $iv_strlen = 2 * openssl_cipher_iv_length('AES-256-CTR');
        if (preg_match('/^(.{' . $iv_strlen . '})(.+)$/', $data, $regs)) {
            try {
                list(, $iv, $crypted_string) = $regs;
                $decrypted_string = openssl_decrypt($crypted_string, 'AES-256-CTR', $this->salt, 0, hex2bin($iv));
                return substr($decrypted_string, strlen($this->salt));
            } catch(Exception $ex) {
                return false;
            }
        } else {
            return false;
        }
    }
    /**
     * It is a two way encryption. The result is htlml/link friendly.
     * @param string $data
     * @return string
     */
    public function encrypt($data)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CTR'));
        $encrypted_string = bin2hex($iv) . openssl_encrypt($this->salt . $data, 'AES-256-CTR', $this->salt, 0, $iv);
        return str_replace(array('+', '/'), array('-', '_'),base64_encode($encrypted_string));
    }


    public function menuUpper($leftControls=[],$rightControls=[]) {

        $htmlLeft=$this->renderItem($leftControls);
        $htmlRight=$this->renderItem($rightControls);
        $cin="<body>
		<nav class='navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow'>
		    <span class='navbar-brand col-sm-3 col-md-2 mr-0'>$htmlLeft</span>";

        $cin.="<ul class='navbar-nav px-3'>
		        <li class='nav-item text-nowrap'>
		            <span class='nav-link' href='#'>$htmlRight</span>
		        </li>
		    </ul>
		</nav>";


        $this->html[]=$cin;
        return $this;
    } // menuUpper

    /**
     * It starts a div container
     * 
     * @param string $class (optional)
     *
     * @return $this
     */
    public function startContent($class='container-fluid') {
        $cin="<div class='$class'><div class='row'>\n";
        $this->html[]=$cin;
        return $this;
    } //startContent

    /**
     * It adds a menu
     * 
     * @param LinkOne[]|string[] $links
     * @return $this
     */
    public function menu($links) {
        $cin="<nav class='col-md-2 d-none d-md-block bg-light leftmenu'>
            <div class='leftmenu-sticky'>
                <ul class='nav flex-column'>\n";
        foreach($links as $link) {
            if (is_object($link)) {
                $cin .= "<li class='nav-item'>" . $link->addClass('nav-link')->render() . '</li>';
            } else {
                $cin .= "<li class='nav-item'>$link</li>";
            }
        }
        $cin.= '</ul></div></nav>';
        $this->html[]=$cin;
        $this->hasSideMenu=true;
        return $this;
    } //menu

    public function startMain() {
        if ($this->hasSideMenu) {
            $class= 'col-md-9 ml-sm-auto col-lg-10 px-4';
        } else {
            $class= 'col-md-12 ml-sm-auto col-lg-12 px-4';
        }
        $cin=<<<inout
<main role="main" class="$class">
<form method='post'>
<input type='hidden' name='_ispostback' value='1'/>
inout;
        $this->html[]=$cin;
        return $this;
    } // startMain

    public function endMain() {
        $cin=<<<inout
		</form>
        </main>
inout;
        $this->html[]=$cin;
        return $this;
    } // endMain	

    public function endContent() {
        $cin=<<<inout
    </div>
</div>
inout;
        $this->html[]=$cin;
        return $this;
    } // endContent

    public function title($title,$level=1) {
        $this->html[]="<h{$level}>$title</h{$level}>\n";
        return $this;
    }
    public function rawHtml($html) {
        $this->html[]=$html."\n";
        return $this;
    }

    /**
     * it generates a table
     * Example
     *      ->table([['Col1'=1,'Col2'=>2,'Col3'=>3],['Col1'=1,'Col2'=>2,'Col3'=>3]])
     *      ->table([['Col1'=1,'Col2'=>2,'Col3'=>3],['Col1'=1,'Col2'=>2,'Col3'=>3]]
     *              ,['Col1'=>'Column1','Col2'=>'Column2','Col3'=>'Column3'])
     * @param array $info
     * @param null|string[] $definition (optional) it is the defintion (name of the columns).
     * @param string $class Class of the table
     * @param string $subclass Class of each rows.
     * @return $this
     * @see \DashOne::renderTable
     */
    public function table($info,$definition=null,$class='table',$subclass='') {
        $this->html[]=(new TableOne($info,$definition) )->setClass($class)->setSubClass($subclass);
        return $this;
    }

    /**
     * It generates an unsorted list (ul)
     * Example:
     *      ->ul(['CocaCola','Fanta','Sprite'])
     * @param array $info Array with the info to show
     * @param string $class Name of the class (for ul)
     * @param string $subclass name of each row (for li)
     * @return $this
     */
    public function ul($info,$class='list-group',$subclass='list-group-item') {
        $this->html[]=(new UlOne($info))->setClass($class)->setSubClass($subclass);
        return $this;
    }

    /**
     * It fetchs values from $_POST, $_GET or $_REQUEST and it returns the value in $currentValues<br>
     * It does not sanitize any value.
     *
     * @param array  $currentValues
     * @param string $method =['get','post','fetch'][$i]
     *
     * @return DashOne
     */
    public function fetchValue(&$currentValues,$method='request') {
        foreach($currentValues as $k=>$v) {
            switch ($method) {
                case 'post':
                    $read=@$_POST[$k];
                    break;
                case 'get':
                    $read=@$_GET[$k];
                    break;
                default:
                    $read=@$_REQUEST[$k];
                    break;
            }
            if($read!==null) {
                $currentValues[$k]=$read;
            }
        }
        return $this;
    }

    /**
     * It generates an form
     * Example:
     *      ->form(['Id'=>'','Name'=>''])
     *      ->form(['Id'=>'','Name'=>''],['Id'=>'hidden','Name'=>'text'],['Id'=>'','Name'=>'Name of the field')
     * @param array $currentValues Associative array with the current values and name of the fields
     * @param null|array $definition (optional). An associative array with the type of the fields
     * @param array $messages (optional). An associative array with the name of the description
     * @param string $class Class of the input field
     * @param string $subclass Class of the message field
     * @return $this
     */
    public function form($currentValues,$definition=null,$messages=[],$class='form-control',$subclass='') {
        $this->html[]=(new FormOne($currentValues,$definition,$messages))->setClass($class)->setSubClass($subclass);
        if ($this->hasPost===false) {
            if ($this->csrf) {
                @$_SESSION['_csrf']=uniqid('',true);
                $this->html[] = "<input type='hidden' name='_csrf' value='".@$_SESSION['_csrf']."'/>";
            }
            $this->hasPost=true;
        }
        return $this;
    }
    public function link($name, $url='#', $icon='') {
        $this->html[]=new LinkOne($name,$url,$icon);
        return $this;
    }

    public function checkCSRF() {
        if (!$this->csrf) {
            return true;
        }
        return @$_SESSION['_csrf']===@$_POST['_csrf'];
    }

    /**
     * True is the form was send (for example, the form was called via a submit button)
     * @return bool
     */
    public function isPostBack() {
        return isset($_POST['_ispostback']);
    }

    /**
     * It adds a list of buttons to the dashboard
     * Examples:
     *      ->buttons([new ButtonOne(),new ButtonOne()])
     *      ->buttons([new ButtonOne(),new ButtonOne()],true)
     * @param ButtonOne[]|ButtonOne $buttons array of buttons
     * @param bool $formAligned if true then the button is aligned with the form
     * @return $this
     */
    public function buttons($buttons,$formAligned=false) {
        if ($formAligned) {
            $this->rawHtml("<div class='form-group row'>&nbsp;<div class='col-sm-10 offset-md-2'>");
        }
        $this->html[]=$buttons; // $this::genNode('button',$buttons);
        if ($formAligned) {
            $this->rawHtml('</div></div>');
        }
        return $this;
    }

    /**
     * Macro of buttos
     * Examples:
     *      ->button('frm_button1','Click me','btn btn-default','submit')
     * @param string $name name (and id) of the button. It's also the value.
     * @param string $label label of the button
     * @param string $class=['btn','btn btn-default','btn btn-primary','btn btn-success','btn btn-info','btn btn-warning','btn btn-danger','btn btn-link'][$i]
     * @param string $type=['submit','link','button','reset'][$i]
     * @param string $extra Extra values
     * @param bool $formAligned if true then the button is aligned with the form
     * @return $this
     * @see \eftec\DashOne\DashOne::buttons
     */
    public function button($name, $label, $class='btn', $type='submit',$extra='',$formAligned=false) {
        $button=new ButtonOne($name, $label, $class, $type,$extra);
        return $this->buttons([$button],$formAligned);
    }

    /**
     * @param string $title Title of the alert
     * @param string $content
     * @param string $class It uses the classes of bootstrap 4.1. Example "alert alert-info"
     * @see https://getbootstrap.com/docs/4.1/components/alerts/
     * @return $this
     */
    public function alert($title,$content='',$class=null) {
        $this->html[]=new AlertOne($title,$content,$class);
        return $this;
    }

    /**
     * @param string $url
     * @param string|null $title
     * @return $this
     */
    public function image($url,$title=null) {
        $this->html[]=new ImageOne($url,$title);
        return $this;
    }

    /**
     * Example:
     *      container("<span>%control</span>")->othercontrol()
     * @param $html
     * @return $this
     */
    public function container($html) {
        $this->html[]=new ContainerOne($html);
        return $this;
    }

    /**
     * Set a class of an inner element (for example the class of a "li" inside a "ul".
     * @param $class
     * @return $this
     * @see \eftec\DashOne\controls\ControlOne::setSubClass
     */
    public function setSubClass($class) {
        $last=count($this->html)-1;
        $this->html[$last]->setSubClass($class);
        return $this;
    }
    /**
     * Set a class of an element. It deletes the old class.
     * @param $class
     * @return $this
     * @see \eftec\DashOne\controls\ControlOne::setClass
     */
    public function setClass($class) {
        $last=count($this->html)-1;
        $this->html[$last]->setClass($class);
        return $this;
    }
    /**
     * Set a class of an element. It deletes the old class.
     * @param $class
     * @return $this
     * @see \eftec\DashOne\controls\ControlOne::addClass
     */
    public function addClass($class) {
        $last=count($this->html)-1;
        $this->html[$last]->addClass($class);
        return $this;
    }

    /**
     * @param $id
     * @return $this
     * @see \eftec\DashOne\controls\ControlOne::setId
     */
    public function setId($id) {
        $last=count($this->html)-1;
        $this->html[$last]->setId($id);
        return $this;
    }

    /**
     * It sets an extra content inside the last object
     * Example:
     *      ->alert(...)->setExtra('<b>extra</b>')
     * @param $extraHtml
     * @return $this
     * @see \eftec\DashOne\controls\ControlOne::setExtra
     */
    public function setExtra($extraHtml) {
        $last=count($this->html)-1;
        $this->html[$last]->setExtra($extraHtml);
        return $this;
    }

    /**
     * It adds an extra content inside the last object.
     * Example:
     *      ->alert(...)->addExtra('<b>extra</b>')
     * @param $extraHtml
     * @return $this
     * @see \eftec\DashOne\controls\ControlOne::addExtra
     */
    public function addExtra($extraHtml) {
        $last=count($this->html)-1;
        $this->html[$last]->addExtra($extraHtml);
        return $this;
    }
    /**
     * Render the dashboard
     * @param bool $return
     * @return string|null
     */
    public function render($return=false) {

        $co=count($this->html);
        $html= '';
        for($i=0;$i<$co;$i++) {
            $html.=$this->renderItem($i);
        }
        if ($return) {
            return $html;
        }

        echo $html;
        return null;
    }

    /**
     * @param int|array $idHtml If int then it returns the item loaded on $this->html
     * @return array|mixed|string
     */
    public function renderItem(&$idHtml) {
        if (is_numeric($idHtml)) {
            $item = $this->html[$idHtml];
        } else {
            $item=$idHtml;
        }
        if (is_array($item)) {
            $result='';
            foreach($item as $node) {
                $result.=$this->renderItem($node);
            }
            return $result;
        }
        if (is_object($item)) {
            //$defType= (!isset($item['_def']))?@$item[0]['_def']:$item['_def'];
            $tmpArr=explode('\\',get_class($item));
            $defType=end($tmpArr);

            switch ($defType) {
                case 'TableOne':
                    /** @see \eftec\DashOne\controls\TableOne::render */
                    return $item->render($this);
                    break;
                case 'UlOne':
                    /** @see \eftec\DashOne\controls\UlOne::render */
                    return $item->render($this);
                    break;
                case 'FormOne':
                    /** @see \eftec\DashOne\controls\FormOne::render */
                    return  $item->render();
                    break;
                case 'ButtonOne':
                    /** @see \eftec\DashOne\controls\ButtonOne::render */
                    return $item->render();
                    break;
                case 'AlertOne':
                    /** @see \eftec\DashOne\controls\AlertOne::render */
                    return $item->render();
                    break;
                case 'ImageOne':
                    /** @see \eftec\DashOne\controls\ImageOne::render */
                    return $item->render();
                    break;

                case 'LinkOne':
                    /** @see \eftec\DashOne\controls\LinkOne::render */
                    return $item->render();
                    break;
                case 'ContainerOne':
                    $idHtml++;
                    /** @see \eftec\DashOne\controls\ContainerOne::render */
                    return  $item->render($this->renderItem($idHtml));
                    break;
                default:
                    die("Class [$defType] not defined for render (DashOne)");
            }
        } else {
            return $item;
        }
    }

} // end class DashOne