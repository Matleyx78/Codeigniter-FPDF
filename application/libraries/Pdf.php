<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/fpdf/fpdf.php";
 
class Pdf extends FPDF {
        
    public function __construct() 
        {
            parent::__construct();
        }
        
    public function Header()
        {
            $this->SetLeftMargin(15);
            $this->SetRightMargin(15);
            $this->Ln(15);
            $this->SetFont('Arial','B',16);
        }

    public function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
        }
}
?>;

