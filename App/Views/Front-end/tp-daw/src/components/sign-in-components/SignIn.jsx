import React from "react";
import Divider from "@mui/material/Divider";
import Paper from "@mui/material/Paper";
import FormSignIn from "./FormSignIn";
import AvatarLogo from "./AvatarLogo";
import Box from "@mui/material/Box";

function SignIn() {
  return (
    <>
      <Box sx={{ maxHeight: "100vh", padding: 5 }}>
        <Paper
          elevation={3}
          sx={{
            maxWidth: "sm",
            background:
              "linear-gradient(to bottom left,rgba(153, 221, 248, 0.58), #62adeb9d)",
            borderRadius: 2,
            minHeight: "100%",
            minWidth: "60vh",
            maxHeight: "100%",
            alignItems: "stretch",
            display: "flex",
            flexDirection: "column",
            justifyContent: "top",
            padding: 4,
          }}
        >
          <AvatarLogo />
          <Divider sx={{ margin: 1 }}>Sign in</Divider>
          <FormSignIn />
        </Paper>
      </Box>
    </>
  );
}

export default SignIn;
