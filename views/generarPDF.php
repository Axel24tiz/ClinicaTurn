<?php
require_once '../libs/fpdf/fpdf.php';
session_start();

// Verificar si los datos del turno están en sesión
if (!isset($_SESSION['turno_confirmado'])) {
    echo "No hay información de turno disponible.";
    exit;
}

$turno = $_SESSION['turno_confirmado'];

// Extraer los datos del turno
$nombre_paciente = $turno['nombre_paciente'] ?? 'Indefinido';
$apellido_paciente = $turno['apellido_paciente'] ?? 'Indefinido';
$fecha = $turno['fecha'] ?? 'Indefinido';
$hora = $turno['hora'] ?? 'Indefinido';
$nombre_medico = $turno['nombre_medico'] ?? 'Indefinido';
$tipo_turno = $turno['tipo_turno'] ?? 'Indefinido';
$email = $turno['email'] ?? 'Indefinido';

// Crear una instancia de FPDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// Agregar el logo
$pdf->Image(__DIR__ . '/../views/CLINICA_KRAUSE.png', 10, 10, 30);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Clinica Ottokrause - Turno Confirmado', 0, 1, 'C');
$pdf->Ln(20);

// Agregar detalles del turno
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(230, 230, 230);

// Tabla de datos

$pdf->Cell(50, 10, 'Paciente:', 1, 0, 'L', true);
$pdf->Cell(140, 10, "{$nombre_paciente} {$apellido_paciente}", 1, 1, 'L');
$pdf->Cell(50, 10, 'Fecha:', 1, 0, 'L', true);
$pdf->Cell(140, 10, $fecha, 1, 1, 'L');
$pdf->Cell(50, 10, 'Hora:', 1, 0, 'L', true);
$pdf->Cell(140, 10, $hora, 1, 1, 'L');
$pdf->Cell(50, 10, 'Medico:', 1, 0, 'L', true);
$pdf->Cell(140, 10, "Dr./Dra. {$nombre_medico}", 1, 1, 'L');
$pdf->Cell(50, 10, 'Tipo de Turno:', 1, 0, 'L', true);
$pdf->Cell(140, 10, $tipo_turno, 1, 1, 'L');
$pdf->Cell(50, 10, 'Email:', 1, 0, 'L', true);
$pdf->Cell(140, 10, $email, 1, 1, 'L');


// Pie de página
$pdf->Ln(20);
$pdf->SetFont('Arial', 'I', 10);
$pdf->MultiCell(0, 10, "Por favor, llegue 30 minutos antes para confirmar su asistencia con la secretaría.\nClinica Ottokrause agradece su confianza.", 0, 'C');

// Salida del PDF
$pdf->Output('I', 'Turno_Confirmado.pdf');
?>
