<?php

namespace MunawarHussain14\QrCode;

use Illuminate\Support\ServiceProvider;

class QrCodeServiceProvider extends ServiceProvider{
    
    public function boot(){
        //dd("How it works");
    }

    public function register(){
        $this->app->singleton(QRcode::class, function(){
            return new QRcode();
        });
    }
}