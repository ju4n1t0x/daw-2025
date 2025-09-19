<?php
//interfaz que define los metodos

interface IClienteService{
    public function InsertarCliente($cliente);
    public function ActualizarCliente($cliente);
    public function BorrarCliente($id);
    public function ListarTodos();
    public function BuscarPorId($id);
}
