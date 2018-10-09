<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdfmulti extends FPDF {
         protected $col = 0; // Current column
        protected $y0;      // Ordinate of column start
        
        public function __construct() {
        parent::__construct();

    }
function Header()
{
    // Page header
    global $title;

    $this->SetFont('Arial','B',15);
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
//    $this->SetDrawColor(0,80,180);
//    $this->SetFillColor(230,230,0);
//    $this->SetTextColor(220,50,50);
//    $this->SetLineWidth(1);
//    $this->Cell($w,9,"title",1,1,'C',true);
    $this->Image('img/geal.png',65,10,0,0);
    $this->Ln(20);
    // Save ordinate
    $this->y0 = $this->GetY();
}

function Footer()
{
    // Page footer
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->SetTextColor(128);
    $this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
}

function SetCol($col)
{
    // Set position at a given column
    $this->col = $col;
    $x = 10+$col*100;
    $this->SetLeftMargin($x);
    $this->SetX($x);
}

function AcceptPageBreak()
{
    // Method accepting or not automatic page break
    if($this->col<1)
    {
        // Go to next column
        $this->SetCol($this->col+1);
        // Set ordinate to top
        $this->SetY($this->y0);
        // Keep on page
        return false;
    }
    else
    {
        // Go back to first column
        $this->SetCol(0);
        // Page break
        return true;
    }
}

function ChapterTitle($num, $label)
{
    // Title
    $this->SetFont('Arial','B',12);
    $this->SetFillColor(255,255,255);
    $this->Cell(0,6,"".$num." - ".$label."",0,1,'C',true);
    $this->Ln(4);
    // Save ordinate
    $this->y0 = $this->GetY();
}

function ChapterBody($file,$dati)
{
    // Read text file
    $txt = $file;
    // Font
    $this->SetFont('Arial','',9);
    $h = 5; //altezza riga
    // Output text in a 6 cm width column
    foreach ($txt as $l)
        {
        $chiave = 0;
        $chiave = array_search($l['art'], array_column($dati, 'arcodiceart'));
        switch ($l['tipo'])
            {
            case 1:
                
//                        $this->Cell(40,$h,$l['art'],'BTL',0,'L',0);
//                        $this->Cell(28,$h,$dati[$chiave]['sco']." - ".$dati[$chiave]['arcatscm'],'BT',0,'L',0);
//                        $this->Cell(8,$h,"Eur",'BT',0,'C',0);
//                        $this->Cell(14,$h,"".$dati[$chiave]['prezzofinito']."-".$dati[$chiave]['modificato'],'BTR',0,'R',0);
//                        $this->Ln();                

//                        $this->Cell(68,$h,$l['desc'],'BTL',0,'L',0);
//                        $this->Cell(8,$h,"Eur",'BT',0,'C',0);
//                        $this->Cell(14,$h,"".$dati[$chiave]['prezzofinito']."",'BTR',0,'R',0);
//                        $this->Ln();                        
                        
                if ($chiave != 0)
                    {
                        $this->Cell(40,$h,$l['art'],'BTL',0,'L',0);
                        
                        //  Se voglio vedere gli sconti devo lasciare questa riga
                        $this->Cell(28,$h,$dati[$chiave]['sco']." - ".$dati[$chiave]['arcatscm'],'BT',0,'L',0);
                        // Altrimenti lasci questa
                        //$this->Cell(28,$h,"",'BT',0,'L',0);
                        
                        $this->Cell(8,$h,"Eur",'BT',0,'C',0);
                        
                        //  Se voglio vedere gli sconti devo lasciare questa riga
                        $this->Cell(14,$h,"".$dati[$chiave]['prezzofinito']."-".$dati[$chiave]['modificato'],'BTR',0,'R',0);
                        // Altrimenti lasci questa
                        //$this->Cell(14,$h,"".$dati[$chiave]['prezzofinito'],'BTR',0,'R',0);
                        
                        $this->Ln();        
                    }
                    else 
                        {
                        $this->Cell(40,$h,$l['art'],'BTRL',0,'L',0);
                        $this->Cell(50,$h,"NON TROVATO",'BTRL',0,'L',0);
                        $this->Ln();                
                        }
                break;
            case 2:
                $this->SetFont('Arial','B',10);
                $this->Cell(90,$h,$l['desc'],'BTRL',0,'L',0);
                $this->SetFont('Arial','',9);
                $this->Ln();
                break;
            case 3:
                $this->Cell(90,$h,"",'BTRL',0,'L',0);
                $this->Ln();
                break;
            case 4:
                $this->Cell(68,$h,"RIV Legno (solo interno)",'BTL',0,'L',0);
                $this->Cell(8,$h,"Eur",'BT',0,'C',0);
                $this->Cell(14,$h,"+ 1,95",'BTR',0,'R',0);
                $this->Ln();
                break;
            }
            

        }

    // Mention
//    $this->SetFont('','I');
//    $this->Cell(0,5,'(end of excerpt)');
    // Go back to first column
    $this->SetCol(0);
}

function ChapterBody1($file,$dati)
{
    // Read text file
    $txt = $file;
    // Font
    $this->SetFont('Arial','',9);
    $h = 5; //altezza riga
    // Output text in a 6 cm width column
    foreach ($txt as $l)
        {
        $chiave = 0;
        $chiave = array_search($l['art'], array_column($dati, 'arcodiceart'));
        switch ($l['tipo'])
            {
            case 1:
                if ($chiave != 0)
                    {
                        $this->Cell(10,$h,"",'BTRL',0,'C',0);                        
                        $this->Cell(25,$h,$l['art'],'BTL',0,'L',0);
                        $this->Cell(110,$h,$dati[$chiave]['ardesart'],'BT',0,'L',0);
                        
                        $this->Cell(15,$h,"Eur/".$dati[$chiave]['arunmis1'],'BT',0,'C',0);
                        
                        //$this->Cell(20,$h,"".$dati[$chiave]['prezzofinito']."-".$dati[$chiave]['modificato'],'BTR',0,'R',0);
                        $this->Cell(20,$h,"".$dati[$chiave]['prezzofinito'],'BTR',0,'R',0);
                        
                        $this->Cell(10,$h,"",'BTRL',0,'C',0);
                        $this->Ln();        
                    }
                    else 
                        {
                        $this->Cell(10,$h,"",'BTRL',0,'L',0);
                        $this->Cell(40,$h,$l['art'],'BTRL',0,'L',0);
                        $this->Cell(40,$h,"",'BTRL',0,'L',0);
                        $this->Ln();                
                        }
                break;
            case 2:
                $this->SetFont('Arial','B',10);
                $this->Cell(90,$h,$l['desc'],'BTRL',0,'L',0);
                $this->SetFont('Arial','',9);
                $this->Ln();
                break;
            case 3:
                $this->Cell(10,$h,"",'BTRL',0,'L',0);
                $this->Cell(25,$h,"",'BTL',0,'L',0);
                $this->Cell(110,$h,"",'BT',0,'L',0);
                $this->Cell(15,$h,"",'BT',0,'L',0);
                $this->Cell(20,$h,"",'BTR',0,'L',0);
                $this->Cell(10,$h,"",'BTRL',0,'L',0);
                $this->Ln();
                break;
            }
            

        }

    // Mention
//    $this->SetFont('','I');
//    $this->Cell(0,5,'(end of excerpt)');
    // Go back to first column
    //$this->SetCol(0);
}


function PrintChapter($num, $title, $file, $dati)
{
    // Add chapter
    $this->AddPage();
    $this->ChapterTitle($num,$title);
    $this->ChapterBody($file, $dati);
}
function PrintChapter1($num, $title, $file, $dati)
{
    // Add chapter
    $this->AddPage();
    $this->ChapterTitle($num,$title);
    $this->ChapterBody1($file, $dati);
}
}


