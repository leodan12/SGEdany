<?php

namespace App\Clases;
use Codedge\Fpdf\Fpdf\Fpdf as Fpdf;


class PDF extends Fpdf
{
    function Header()
    {

    }

    function Footer()
    {

        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}
