<?php
session_start();

// Inclusiones de archivos
require_once __DIR__ . '/../Service/VentaService.php';
require_once __DIR__ . '/../Model/Venta.php';

use App\Model\Venta;
use App\Service\VentaService;

$ventaService = new VentaService();
$ventas = [];
$message = '';
$isError = false;

// Manejar la eliminación de ventas
if (isset($_GET['action']) && $_GET['action'] == 'eliminar' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    try {
        if ($ventaService->eliminarVenta($id)) {
            $_SESSION['success_message'] = 'Venta eliminada exitosamente.';
        } else {
            $_SESSION['error_message'] = 'Hubo un error al eliminar la venta.';
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = 'Error al eliminar la venta: ' . $e->getMessage();
    }
    header('Location: ventas_registrar.php');
    exit;
}

// Obtener todas las ventas para mostrarlas
try {
    $ventas = $ventaService->obtenerTodasLasVentas();
} catch (Exception $e) {
    $_SESSION['error_message'] = "Error al cargar las ventas: " . $e->getMessage();
}

// Si hay un mensaje de sesión, lo mostramos
if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
} elseif (isset($_SESSION['error_message'])) {
    $message = $_SESSION['error_message'];
    $isError = true;
    unset($_SESSION['error_message']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 2em;
            margin: 0;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin-bottom: 2em;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        .message-container {
            padding: 1em;
            margin-bottom: 1em;
            border-radius: 4px;
            text-align: center;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .form-group {
            margin-bottom: 1em;
        }
        label {
            display: block;
            margin-bottom: 0.5em;
            color: #555;
        }
        input, button {
            width: 100%;
            padding: 0.8em;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 1em;
        }
        button:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5em;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        @media (max-width: 600px) {
            .container {
                padding: 1em;
            }
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            tr {
                border: 1px solid #ccc;
                margin-bottom: 0.5em;
            }
            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Registro de Ventas</h1>
    <?php if ($message) : ?>
        <div class="message-container <?php echo $isError ? 'error-message' : 'success-message'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <h2>Registrar Nueva Venta</h2>
    <form action="../procesar_venta.php" method="post">
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" required>
        </div>
        <div class="form-group">
            <label for="cuit_cliente">CUIT del Cliente</label>
            <input type="text" id="cuit_cliente" name="cuit_cliente" required>
        </div>
        <div class="form-group">
            <label for="monto">Monto ($)</label>
            <input type="number" step="0.01" id="monto" name="monto" required>
        </div>
        <button type="submit">Registrar Venta</button>
    </form>

    <h2>Ventas Registradas</h2>
    <?php if (!empty($ventas)) : ?>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>CUIT</th>
                <th>Monto</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ventas as $venta) : ?>
                <tr>
                    <td data-label="ID"><?php echo htmlspecialchars($venta->getIdVenta()); ?></td>
                    <td data-label="Fecha"><?php echo htmlspecialchars($venta->getFecha()); ?></td>
                    <td data-label="CUIT"><?php echo htmlspecialchars($venta->getCuitCliente()); ?></td>
                    <td data-label="Monto">$<?php echo htmlspecialchars(number_format($venta->getMonto(), 2)); ?></td>
                    <td data-label="Acción">
                        <form method="get" action="ventas_registrar.php" style="display:inline;">
                            <input type="hidden" name="action" value="eliminar">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($venta->getIdVenta()); ?>">
                            <button type="submit" class="delete-btn" onclick="return confirm('¿Estás seguro de que deseas eliminar esta venta?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No hay ventas registradas.</p>
    <?php endif; ?>
</div>
</body>
</html>
