<?php

class Flasher
{
    public static function setFlash($type, $msg)
    {
        Session::getInstance()->push('flash', [
            'msg' => $msg,
            'type' => $type
        ]);
    }

    public static function flash()
    {
        if (Session::getInstance()->has('flash')) {
            echo '<div class="alert alert-' . Session::getInstance()->get('flash')['type'] . ' alert-dismissible fade show" role="alert">
                    <strong>' . Session::getInstance()->get('flash')['msg'] . '</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                Session::getInstance()->pop('flash');
        }
    }
}