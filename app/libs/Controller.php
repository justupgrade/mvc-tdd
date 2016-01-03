<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 11.12.15
 * Time: 18:35
 */

class Controller
{
    function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
    }

    protected function redirectUrl($location)
    {
        header('Location: ' . $location);
        exit;
    }

    protected function getErrorsHtml($errors)
    {
        $error = $errors[0]; # display first error
        $out = '<div class="alert alert-danger alert-dismissible" role="alert">';
        $out .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        $out .= '<span aria-hidden="true">&times;</span>';
        $out .= '</button>';
        $out .= '<strong>Error!</strong> ';
        $out .= $error;
        $out .= '</div>';

        return $out;
    }
} 