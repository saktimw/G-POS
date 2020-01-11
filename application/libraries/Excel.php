<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('PHPexcel.php');
class Excel extends PHPExcel
{
    public function __construct()
    {
        parent::__construct();
    }
}

?>