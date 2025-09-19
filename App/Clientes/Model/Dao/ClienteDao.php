<?php
//consultas preparadas PDO a la base de datos
require_once __DIR__ . '/../../../Database/DatabaseConnect.php';
require_once __DIR__ . '/../Class/Cliente.php';
abstract class ClienteDao{

    protected $clienteModel;
    protected $connection;
        public function __construct(){
            $this->connection = DatabaseConection::getInstance()->getConection();
            $this->clienteModel = new Cliente();
        }
        public function InsertarCliente($clienteService){
            $queryInsert= "INSERT INTO clientes (nombre, apellido, email) VALUES (:nombre, :apellido, :email)";

            $stmt = $this->connection->prepare($queryInsert);;
            $stmt->execute([
                ':nombre' => $clienteService->getNombre(),
                ':apellido' => $clienteService->getApellido(),
                ':email' => $clienteService->getEmail()
            ]);

        }

    public function BorrarCliente($id){
        $conexion = DatabaseConnect::getInstance()->getConection();

        $queryDelete= "DELETE FROM clientes WHERE id = :id";

        $stmt= $conexion->prepare($queryDelete);
        $stmt->execute([
            ':id' => $id
        ]);

    }

    public function ListarClientes($cliente){
        $conexion = DatabaseConnect::getInstance()->getConection();

        $queryFindAll= "SELECT * FROM clientes";

        $stmt= $conexion->prepare($queryFindAll);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function ListarClientePorId($id){
        $conexion = DatabaseConnect::getInstance()->getConection();

        $queryFindById= "SELECT * FROM clientes WHERE id = :id";

        $stmt= $conexion->prepare($queryFindById);

        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function ActualizarClientes($cliente){
        $conexion = DatabaseConnect::getInstance()->getConection();

        $queryUpdate= "UPDATE clientes SET nombre = :nombre, apellido = :apellido, email = :email WHERE id = :id";

        $stmt= $conexion->prepare($queryUpdate);
        $stmt->execute([
            ':nombre' => $cliente->getNombre(),
            ':apellido' => $cliente->getApellido(),
            ':email' => $cliente->getEmail(),
            ':id' => $cliente->getId()
        ]);

    }

}