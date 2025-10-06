import * as React from "react";
import Box from "@mui/material/Box";
import Drawer from "@mui/material/Drawer";
import List from "@mui/material/List";
import Divider from "@mui/material/Divider";
import ListItem from "@mui/material/ListItem";
import ListItemButton from "@mui/material/ListItemButton";
import ListItemIcon from "@mui/material/ListItemIcon";
import ListItemText from "@mui/material/ListItemText";
import InboxIcon from "@mui/icons-material/MoveToInbox";
import MailIcon from "@mui/icons-material/Mail";
import CurrencyExchangeIcon from "@mui/icons-material/CurrencyExchange";
import EmojiPeopleIcon from "@mui/icons-material/EmojiPeople";
import { useNavigate } from "react-router-dom";

export default function Menu({ open, onClose }) {
  const navigate = useNavigate();
  const anchor = "left";

  const toggleDrawer = (anchor, open) => (event) => {
    if (
      event.type === "keydown" &&
      (event.key === "Tab" || event.key === "Shift")
    ) {
      return;
    }

    setState({ ...state, [anchor]: open });
  };

  const menuItems = [
    {
      text: "Usuarios",
      icon: <CurrencyExchangeIcon />,
      path: "/home/usuarios",
    },
    { text: "Ventas", icon: <EmojiPeopleIcon />, path: "/home/ventas" },
  ];

  const handleNavigation = (path) => {
    navigate(path);
    onClose();
  };

  const list = (anchor) => (
    <Box
      sx={{ width: anchor === "top" || anchor === "bottom" ? "auto" : 250 }}
      role="presentation"
    >
      <List>
        {menuItems.map(({ text, icon, path }) => (
          <ListItem key={text} disablePadding>
            <ListItemButton onClick={() => handleNavigation(path)}>
              <ListItemIcon>{icon}</ListItemIcon>
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
          sx: {
            top: { xs: 56, sm: 64 },
            height: { xs: "calc(100vh - 56px)", sm: "calc(100vh - 64px)" },
          },
        }}
      >
        {list()}
      </Drawer>
    </div>
  );
}
