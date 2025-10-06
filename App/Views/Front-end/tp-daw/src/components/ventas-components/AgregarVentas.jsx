import Box from "@mui/material/Box";
import TextField from "@mui/material/TextField";
import Button from "@mui/material/Button";
import { useNavigate } from "react-router-dom";
import ArrowCircleRightIcon from "@mui/icons-material/ArrowCircleRight";
import axios from "axios";
import { useState } from "react";

function FormSignIn() {
  const [values, setValues] = useState({
    fecha: "",
    cuit_cliente: "",
    monto: "",
  });

  const navigate = useNavigate();

  const handleSubmit = (event) => {
    event.preventDefault();
    if (!values.fecha || !values.cuit_cliente || !values.monto) {
      alert("Por favor, completa todos los campos");
      return;
    }
    axios
      .post("http://localhost/daw2025/TP/Public/ventas", {
        fecha: values.fecha,
        cuit_cliente: values.cuit_cliente,
        monto: values.monto,
      })
      .then((response) => {
        console.log(response);
        alert("Venta agregada con éxito");
        navigate("/home/ventas", {
          state: { refresh: Date.now() },
        });
      })
      .catch((error) => {
        console.log(error);
      });
  };

  return (
    <>
      <Box
        component="form"
        onSubmit={handleSubmit}
        sx={{
          display: "flex",
          flexDirection: "column",
          alignItems: "start",
          padding: 4,
          gap: 1,
        }}
        noValidate
        autoComplete="off"
      >
        <h4>Fecha de Venta</h4>
        <TextField
          required
          id="outlined-required"
          name="Fecha de Venta"
          type="date"
          value={values.fecha}
          onChange={(e) => setValues({ ...values, fecha: e.target.value })}
          sx={{ minWidth: "100ch" }}
        />
        <h4>Cuit de Cliente</h4>
        <TextField
          required
          id="outlined-required"
          name="Cuit de Cliente"
          label="Required"
          value={values.cuit_cliente}
          onChange={(e) =>
            setValues({ ...values, cuit_cliente: e.target.value })
          }
          sx={{ minWidth: "100ch" }}
        />
        <h4>Importe</h4>
        <TextField
          required
          id="outlined-required"
          name="Importe"
          label="Required"
          value={values.monto}
          onChange={(e) => setValues({ ...values, monto: e.target.value })}
          sx={{ minWidth: "100ch" }}
        />

        <Button
          type="submit"
          variant="contained"
          endIcon={<ArrowCircleRightIcon />}
          sx={{
            padding: 1,
            marginTop: 2,
            width: "100ch",
            alignSelf: "start",
            gap: 2,
          }}
        >
          Agregar Venta
        </Button>
      </Box>
    </>
  );
}
export default FormSignIn;
