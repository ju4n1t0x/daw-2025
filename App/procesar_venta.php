<?php
session_start();

// Usa rutas relativas para el script de procesamiento
// que ahora está en /App/
require_once __DIR__ . '/../core/ConexionVenta.php';
require_once __DIR__ . '/Service/VentaService.php';
require_once __DIR__ . '/Model/Venta.php';

use App\Model\Venta;
use App\Service\VentaService;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $cuit_cliente = $_POST['cuit_cliente'];
    $monto = $_POST['monto'];

    try {
        $ventaService = new VentaService();
        $venta = new Venta(null, $fecha, $cuit_cliente, $monto);

        if ($ventaService->agregarVenta($venta)) {
            $_SESSION['success_message'] = '¡Venta registrada exitosamente!';
        } else {
            $_SESSION['error_message'] = 'Hubo un error al registrar la venta.';
        }
    } catch (\Exception $e) {
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
    }

    // Redirige al formulario con un mensaje de éxito o de error
    // La ruta es absoluta y siempre debe funcionar
    header('Location: /daw-2025/App/Views/ventas_registrar.php');
    exit();
}

