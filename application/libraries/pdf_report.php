<?php

require_once dirname(__FILE__).'/tcpdf/tcpdf.php';
    class pdf_report extends TCPDF
    {
        public function __construct()
        {
            parent::__construct();
        }
    }