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
            $flashMessage = '<div class="alert z-3 alert-' . Session::getInstance()->get('flash')['type'] . ' alert-dismissible fade show" role="alert">
            <strong>' . Session::getInstance()->get('flash')['msg'] . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            Session::getInstance()->pop('flash');
            return $flashMessage;
        }
    }
}
