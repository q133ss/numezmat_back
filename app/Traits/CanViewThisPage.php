<?php
namespace App\Traits;

trait CanViewThisPage{
    public function checkViewPermission($permission)
    {
        $this->middleware('permission:'.$permission)->only(['index','show','detail']);
    }
}
