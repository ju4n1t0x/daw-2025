import Box from "@mui/material/Box";
import TextField from "@mui/material/TextField";
import Button from "@mui/material/Button";
import { useNavigate } from "react-router-dom";
import ArrowCircleRightIcon from "@mui/icons-material/ArrowCircleRight";
import axios from "axios";
import { useState } from "react";

function FormSignIn() {
  const [values, setValues] = useState({
    nombreUsuario: "",
    contrasena: "",
  });

  const navigate = useNavigate();

  const handleSubmit = (event) => {
    event.preventDefault();
    axios
      .post("http://localhost/daw2025/TP/Public/login", {
        nombreUsuario: values.nombreUsuario,
        contrasena: values.contrasena,
      })
      .then((response) => {
        console.log(response);
        navigate("/home");
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
          justifyContent: "center",
          padding: 4,
          gap: 1,
        }}
        noValidate
        autoComplete="off"
      >
        <h4>Nombre de Usuario</h4>
        <TextField
          required
          id="outlined-required"
          name="nombreUsuario"
          label="Required"
          value={values.nombreUsuario}
          onChange={(e) =>
            setValues({ ...values, nombreUsuario: e.target.value })
          }
          sx={{ minWidth: "60ch" }}
        />
        <h4>Contraseña</h4>
        <TextField
          required
          id="outlined-password-input"
          name="contrasena"
          type="password"
          label="Contraseña"
          autoComplete="current-password"
          variant="filled"
          value={values.contrasena}
          onChange={(e) => setValues({ ...values, contrasena: e.target.value })}
          sx={{ minWidth: "60ch" }}
        />

        <Button
          type="submit"
          variant="contained"
          endIcon={<ArrowCircleRightIcon />}
          sx={{
            padding: 1,
            marginTop: 2,
            width: "60ch",
            alignSelf: "center",
            gap: 2,
          }}
        >
          Ingresar
        </Button>
      </Box>
    </>
  );
}
export default FormSignIn;
