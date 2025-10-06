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
      .get("http://localhost/daw2025/TP/Public/ventas")
      .then((response) => {
        console.log("Datos del backend:", response.data);
        setData(response.data);
      })
      .catch((error) => {
        console.error("Error en traer los datos desde la api:", error);
      });
  };
  React.useEffect(() => {
    fetchData();
  }, [location.state?.refresh]);

  const columns = [
    { field: "id", headerName: "ID", width: 130 },
    { field: "fecha", headerName: "Fecha", width: 200 },
    { field: "cuit_cliente", headerName: "CUIT Cliente", width: 200 },
    { field: "monto", headerName: "Importe", type: "number", width: 200 },
  ];

  const rows = data.map((item) => ({
    id: item.id_venta,
    fecha: item.fecha,
    cuit_cliente: item.cuit_cliente,
    monto: item.monto,
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
