<?php


namespace application\controllers;

use application\core\Controller;
use application\core\Model;
use application\core\View;

class ErrorController extends Controller
{
    public function index()
    {

        if(isset($_SESSION['error_message'])) {
            $error_message = urldecode($_SESSION['error_message']);
            unset($_SESSION['error_message']);
        } else {
            $error_message = '';
        }

        $vars = [
            'error_message' => $error_message,
        ];

        return View::render('error/index', $vars);
    }
}