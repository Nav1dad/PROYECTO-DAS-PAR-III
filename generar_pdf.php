<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo (opcional)

    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Encabezado de tabla
    function FancyTableHeader()
    {
        $this->SetFillColor(230, 230, 230); // Color de fondo
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 10, 'Concepto', 1, 0, 'C', true);
        $this->Cell(130, 10, 'Detalles', 1, 1, 'C', true);
    }

    // Fila de la tabla
    function FancyTableRow($label, $value)
    {
        $this->SetFont('Arial', '', 12);
        $this->Cell(50, 10, utf8_decode($label), 1, 0, 'L');
        $this->Cell(130, 10, utf8_decode($value), 1, 1, 'L');
    }
}

require("conexion.php");

if (isset($_GET['id_autor'])) {
    $id_autor = $_GET['id_autor'];

    $consulta = "SELECT * FROM autor WHERE id_autor = $id_autor";
    $resultado = mysqli_query($conexion, $consulta);

    if ($row = mysqli_fetch_assoc($resultado)) {
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        // Tabla de datos
        $pdf->FancyTableHeader();
        $pdf->FancyTableRow('Tipo de Comprobante', $row['t_comprobante']);
        $pdf->FancyTableRow('Nombre del Cliente', $row['nombre']);
        $pdf->FancyTableRow('Crédito Fiscal', $row['cf']);
        $pdf->FancyTableRow('Consumidor Final', $row['con_f']);
        $pdf->FancyTableRow('Número de Comprobante', $row['n_comprobante']);
        $pdf->FancyTableRow('Fecha del Comprobante', $row['f_comprobante']);
        $pdf->FancyTableRow('Monto', $row['monto']);

        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, utf8_decode('Gracias por su preferencia.'), 0, 1, 'C');

        $pdf->Output();
    } else {
        echo "No se encontró al autor.";
    }
} else {
    echo "ID del autor no especificado.";
}
?>
