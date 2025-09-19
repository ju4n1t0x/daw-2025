import Box from '@mui/material/Box';
import TextField from '@mui/material/TextField';
import Button from '@mui/material/Button';
import {useNavigate} from 'react-router-dom'
import ArrowCircleRightIcon from '@mui/icons-material/ArrowCircleRight';

function FormSignIn() {

  const navigate = useNavigate();
  const onClick =() => {
    navigate('/home')
  };

   return( 
   <>
   <Box component="form"
    sc={{'& .MuiTextField-root': { }}}
    sx={{display: 'flex', 
      flexDirection: 'column', 
      alignItems: 'start', 
      justifyContent: 'center', 
      padding: 5,
    gap: 1}} 
    noValidate
    autoComplete="off">
      
        <h4>Nombre de Usuario</h4>
        <TextField
          required
          id="outlined-required"
          label="Required"
          defaultValue="User Name"
          sx={{minWidth: '60ch'}}
        />
        <h4>Contraseña</h4>
      <TextField
          
          id="outlined-password-input"
          label="Password"
          type="password"
          autoComplete="current-password"
          variant="filled"
          sx={{minWidth: '60ch'}}
        />
      
    </Box>
    <Button onClick={onClick} variant="contained" endIcon={<ArrowCircleRightIcon />} sx={{padding: 1, width: '60ch', alignSelf: 'center', gap: 2}}>
  Ingresar
</Button>
    </>
   )}
   export default FormSignIn