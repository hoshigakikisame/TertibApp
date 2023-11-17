<?php

class Flasher
{
    public static function setFlash($type, $msg)
    {
        Session::push('flash', [
            'msg' => $msg,
            'type' => $type
        ]);
    }

    public static function flash()
    {
        if (Session::has('flash')) {
            echo '<div class="alert alert-' . Session::get('flash')['type'] . ' alert-dismissible fade show" role="alert">
                    <strong>' . Session::get('flash')['msg'] . '</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            Session::pop('flash');
        }
    }
}