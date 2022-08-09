<?php
define('PAGINATION_COUMT', 20);

 function getFolder(){
    return app()->getLocale()==='ar'?'css-rtl':'css';
}
