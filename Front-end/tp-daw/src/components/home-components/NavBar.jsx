import * as React from 'react';
import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';
import Button from '@mui/material/Button';
import IconButton from '@mui/material/IconButton';
import MenuIcon from '@mui/icons-material/Menu';
import Menu from './Menu';
import {useNavigate} from 'react-router-dom';



export default function ButtonAppBar() {
  const navigate = useNavigate();
  const handleNavigation = (path) =>{
    navigate(path);
  }

  const [showMenu, setShowMenu] = React.useState(false);
  return (
    <Box sx={{ flexGrow: 1 }}>
      <AppBar className="NavBAr" position="static" sx={{
    background: (theme) =>
      `linear-gradient(to left, ${theme.palette.secondary.main}, ${theme.palette.primary.main})`, height: "70px"
  }}>
    

        <Toolbar>
          <IconButton
            size="large"
            edge="start"
            color="inherit"
            aria-label="menu"
            sx={{ mr: 2 }}
            onClick={() => setShowMenu((prev) => !prev)}
          >
            <MenuIcon />
          </IconButton>
          <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
            DawAPP
          </Typography>
          <Button color="inherit" onClick={() => handleNavigation('/')}>Log-Out</Button>
        </Toolbar>
      </AppBar>
      
      <Menu open={showMenu} onClose={() => setShowMenu(false)} />
      
    </Box>
  );
}