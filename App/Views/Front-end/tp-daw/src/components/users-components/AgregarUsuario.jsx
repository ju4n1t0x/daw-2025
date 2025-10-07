import Box from "@mui/material/Box";
import TextField from "@mui/material/TextField";
import Button from "@mui/material/Button";
import { useNavigate } from "react-router-dom";
import ArrowCircleRightIcon from "@mui/icons-material/ArrowCircleRight";
import axios from "axios";
import { useState } from "react";

function FormSignIn() {
  const [values, setValues] = useState({
    nombre_usuario: "",
    email: "",
    contrasena: "",
    rol: "",
  });

  const navigate = useNavigate();

  const handleSubmit = (event) => {
    event.preventDefault();
    if (
      !values.nombre_usuario ||
      !values.email ||
      !values.contrasena ||
      !values.rol
    ) {
      alert("Por favor, completa todos los campos");
      return;
    }
    axios
      .post("http://localhost/daw2025/TP/Public/usuarios", {
        nombre_usuario: values.nombre_usuario,
        email: values.email,
        contrasena: values.contrasena,
        rol: values.rol,
      })
      .then((response) => {
        console.log(response);
        alert("Usuario agregado con éxito");
        navigate("/home/usuarios", {
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
        <h4>Nombre de Usuario </h4>
        <TextField
          required
          id="outlined-required"
          name="Nombre de Usuario"
          label="Required"
          value={values.nombre_usuario}
          onChange={(e) =>
            setValues({ ...values, nombre_usuario: e.target.value })
          }
          sx={{ minWidth: "100ch" }}
        />
        <h4>Email</h4>
        <TextField
          required
          id="outlined-required"
          name="Email"
          label="Required"
          type="password"
          value={values.email}
          onChange={(e) => setValues({ ...values, email: e.target.value })}
          sx={{ minWidth: "100ch" }}
        />
        <h4>Contraseña</h4>
        <TextField
          required
          id="outlined-required"
          name="Contraseña"
          label="Required"
          value={values.contrasena}
          onChange={(e) => setValues({ ...values, contrasena: e.target.value })}
          sx={{ minWidth: "100ch" }}
        />
        <h4>Rol</h4>
        <TextField
          required
          id="outlined-required"
          name="Rol"
          label="Required"
          value={values.rol}
          onChange={(e) => setValues({ ...values, rol: e.target.value })}
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
          Agregar Usuario
        </Button>
      </Box>
    </>
  );
}
export default FormSignIn;
