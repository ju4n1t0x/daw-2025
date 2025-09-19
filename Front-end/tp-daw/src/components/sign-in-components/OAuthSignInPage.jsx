import * as React from 'react';
import { AppProvider } from '@toolpad/core/AppProvider';
import { SignInPage } from '@toolpad/core/SignInPage';
import { useTheme } from '@mui/material/styles';
import Box from '@mui/material/Box';



const providers = [
  { id: 'github', name: 'GitHub' },
  { id: 'google', name: 'Google' },
  { id: 'facebook', name: 'Facebook' },
  
];



const signIn = async (provider) => {
  
  const promise = new Promise((resolve) => {
    setTimeout(() => {
      console.log(`Sign in with ${provider.id}`);
      resolve({ error: 'This is a fake error' });
    }, 500);
  });
  // preview-end
  return promise;
};

export default function OAuthSignInPage() {
  const theme = useTheme();
  return (
    <AppProvider theme={theme}>
      <Box
        sx={{
          width: '100%',
          height: '40vh',
          p: 0,

          // Neutralizar paddings/márgenes internos frecuentes
          '& .MuiContainer-root': {
            px: 0,
            mx: 0,
            
          },
          '& .MuiPaper-root': {
            background: 'transparent',
            m: 0,
            p: 0,
          },
          '& .MuiStack-root': {
            gap: 1,
            m: 0,
            my: 1,
          },
          '& .MuiBox-root': {
            justifyContent: 'start',
            m: 0,
            p: 0,
          },
          '& .MuiTypography-root': {
            display: 'none',
            mt: 0,
            mb: 0,
            '& h1, & h2, & h3': {
            mt: 0,
          },
          }
          
        }}
      >
        <SignInPage signIn={signIn} providers={providers} />
      </Box>
    </AppProvider>
  );
}