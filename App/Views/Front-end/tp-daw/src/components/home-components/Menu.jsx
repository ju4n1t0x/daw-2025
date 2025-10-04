import * as React from 'react';
import Box from '@mui/material/Box';
import Drawer from '@mui/material/Drawer';
import List from '@mui/material/List';
import Divider from '@mui/material/Divider';
import ListItem from '@mui/material/ListItem';
import ListItemButton from '@mui/material/ListItemButton';
import ListItemIcon from '@mui/material/ListItemIcon';
import ListItemText from '@mui/material/ListItemText';
import InboxIcon from '@mui/icons-material/MoveToInbox';
import MailIcon from '@mui/icons-material/Mail';
import CurrencyExchangeIcon from '@mui/icons-material/CurrencyExchange';
import EmojiPeopleIcon from '@mui/icons-material/EmojiPeople';

export default function Menu({open, onClose}) {
  const anchor = 'left';

  const toggleDrawer = (anchor, open) => (event) => {
    if (event.type === 'keydown' && (event.key === 'Tab' || event.key === 'Shift')) {
      return;
    }

    setState({ ...state, [anchor]: open });
  };

  const menuItems =[
    {text: 'Users', icon: <CurrencyExchangeIcon />},
    {text: 'Ventas', icon: <EmojiPeopleIcon />},
    {text: 'Cambiar', icon: <CurrencyExchangeIcon />},
    {text: 'Cambiar', icon: <CurrencyExchangeIcon />},
  ]

  const list = (anchor) => (
    <Box
      sx={{ width: anchor === 'top' || anchor === 'bottom' ? 'auto' : 250 }}
      role="presentation"
      
      onClick={onClose}
      onKeyDown={onClose}
    >
      <List>
        {menuItems.map(({text, icon}) => (
          <ListItem key={text} disablePadding>
            <ListItemButton>
              <ListItemIcon>
                {icon}
              </ListItemIcon>
              <ListItemText primary={text} />
            </ListItemButton>
          </ListItem>
        ))}
      </List>
      <Divider />
      <List>
        {['All mail', 'Trash', 'Spam'].map((text, index) => (
          <ListItem key={text} disablePadding>
            <ListItemButton>
              <ListItemIcon>
                {index % 2 === 0 ? <InboxIcon /> : <MailIcon />}
              </ListItemIcon>
              <ListItemText primary={text} />
            </ListItemButton>
          </ListItem>
        ))}
      </List>
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
                    top:{xs: 56, sm: 64},
                    height:{xs: 'calc(100vh - 56px)', sm: 'calc(100vh - 64px)'}
                }
            }}
          >
            {list()}
          </Drawer>
    
    </div>
  );
}