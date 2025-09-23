import * as React from 'react';
import {useNavigate} from 'react-router-dom';
import Box from '@mui/material/Box';
import Drawer from '@mui/material/Drawer';
import List from '@mui/material/List';
import Divider from '@mui/material/Divider';
import ListItem from '@mui/material/ListItem';
import ListItemButton from '@mui/material/ListItemButton';
import ListItemIcon from '@mui/material/ListItemIcon';
import ListItemText from '@mui/material/ListItemText';
import CurrencyExchangeIcon from '@mui/icons-material/CurrencyExchange';
import EmojiPeopleIcon from '@mui/icons-material/EmojiPeople';

export default function Menu({open, onClose}) {

  const navigate = useNavigate();
  const anchor = 'left';
  

  const menuItems =[
    {text: 'Users', icon: <CurrencyExchangeIcon/>, path: '/users'},
    {text: 'Ventas', icon: <EmojiPeopleIcon />, path: '/ventas'},
  ]

  const handleNavigation = (path) =>{
    navigate(path);
    onClose();
  }

  const list = (anchor) => (
    <Box
      sx={{ width: anchor === 'top' || anchor === 'bottom' ? 'auto' : 250 }}
      role="presentation"
      
      onClick={onClose}
      onKeyDown={onClose}
    >
      <List>
        {menuItems.map(({text, icon, path}) => (
          <ListItem key={text} disablePadding>
            <ListItemButton onClick={() => handleNavigation(path)}>
              <ListItemIcon>
                {icon}
              </ListItemIcon>
              <ListItemText primary={text} />
            </ListItemButton>
          </ListItem>
        ))}
      </List>
      <Divider />
    </Box>
  );

  return (
    <div>
      
          <Drawer
            anchor={anchor}
            open={open}
            onClose={onClose}
            PaperProps={{
                sx:{
                    top:{xs: 56, sm: 70},
                    height:{xs: 'calc(100vh - 56px)', sm: 'calc(100vh - 70px)'}
                }
            }}
          >
            {list()}
          </Drawer>
    
    </div>
  );
}
  