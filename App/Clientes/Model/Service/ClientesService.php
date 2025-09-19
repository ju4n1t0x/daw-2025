<?php
//implemtariamos los metodos de la interfaz
require__once__DIR__ . '/../Dao/ClienteDao.php';


class ClientesService implements IClienteService{
    private $clienteRepository;
    private $clienteController;
    public function __construct($clienteRepository, $clienteController)
    {
        $this->clienteRepository = $clienteRepository;
        $this->clienteController = $clienteController;
    }


    public function InsertarCliente($clienteController)
    {
        // TODO: Implement InsertarCliente() method.
    }

    public function ActualizarCliente($cliente)
    {
        // TODO: Implement ActualizarCliente() method.
    }

    public function BorrarCliente($id)
    {
        // TODO: Implement BorrarCliente() method.
    }

    public function ListarTodos()
    {
        // TODO: Implement ListarTodos() method.
    }

    public function BuscarPorId($id)
    {
        // TODO: Implement BuscarPorId() method.
    }


}