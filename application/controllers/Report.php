<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Report extends Admin_Controller {
    
    public function __construct()
	{
		parent::__construct();

	}
        
    public function index()
	{
            $this->load->library('pdf');

            $this->pdf = new Pdf();
            $this->pdf->AddPage();
            $this->pdf->AliasNbPages();
            $this->pdf->SetFont('Arial','B',16);
            $this->pdf->Cell(40,10,'Hello World!');

            ob_end_clean();
            $this->pdf->Output("Listas.pdf", 'I');
	}

    function download()
        {
            $this->load->library('pdf');

            $this->pdf = new Pdf();
            $this->pdf->AddPage();
            $this->pdf->AliasNbPages();
            $this->pdf->SetFont('Arial','B',16);
            $this->pdf->Cell(40,10,'Hello Download!');
  
                //ob_end_clean();
            $this->pdf->Output("./tmp/Download.pdf", 'F');
            
            $this->load->library('zip');
            $this->zip->read_file("./tmp/Download.pdf", "Download.pdf");
            $this->zip->archive('Download.zip');
            $this->zip->download('Download.zip');

        }

        
        
        
} 
