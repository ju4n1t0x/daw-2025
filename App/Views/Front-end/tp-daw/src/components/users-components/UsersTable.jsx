import * as React from "react";
import Paper from "@mui/material/Paper";
import { DataGrid } from "@mui/x-data-grid";
import axios from "axios";
import { useLocation } from "react-router-dom";

export default function VentasList() {
  const [data, setData] = React.useState([]);
  const location = useLocation();

  const fetchData = () => {
    axios
      .get("http://localhost/daw2025/TP/Public/usuarios")
      .then((response) => {
        setData(response.data);
      })
      .catch((error) => {
      });
  };
  React.useEffect(() => {
    fetchData();
  }, [location.state?.refresh]);

  const columns = [
    { field: "id", headerName: "ID", width: 130 },
    { field: "nombre_usuario", headerName: "Nombre de Usuario", width: 200 },
    { field: "email", headerName: "Email", width: 200 },
    {
      field: "contrasena",
      headerName: "Contraseña",
      type: "contraseña",
      width: 200,
    },
    { field: "rol", headerName: "Rol", type: "Rol", width: 200 },
  ];

  const rows = data.map((item) => ({
    id: item.id,
    nombre_usuario: item.nombre_usuario,
    email: item.email,
    contrasena: item.contrasena,
    rol: item.rol,
  }));

  const paginationModel = { page: 0, pageSize: 5 };
  return (
    <Paper
      sx={{
        height: 400,
        width: "80%",
      }}
    >
      <DataGrid
        rows={rows}
        columns={columns}
        initialState={{ pagination: { paginationModel } }}
        pageSizeOptions={[5, 10]}
        checkboxSelection
        sx={{ border: 0 }}
      />
    </Paper>
  );
}
