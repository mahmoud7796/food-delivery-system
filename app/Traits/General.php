<?php
namespace App\Traits;

Trait General {

    public function returnRedirectRoute($viewPath,$successOrErrorMessage,$message){
        return redirect()->route($viewPath)->with([$successOrErrorMessage=>$message]);
    }


    public function storeStatus($requestHas,$requestNot,$request){
        if(!$requestHas)
           return $requestNot;
        else
            return $request;
    }
}
