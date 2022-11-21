<?php

namespace App\Http\Controllers\Alumn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alumns\User;
use App\Models\Alumns\PasswordRequest;
use App\Library\Log;
use Input;

class WebsiteController extends Controller
{
    private $logger;

    public function callAction($method, $parameters)
    {
        $this->logger = new Log(HomeController::class);
        return parent::callAction($method, $parameters);
    }

    public function register(){
        return view('Website.register');
    }
}