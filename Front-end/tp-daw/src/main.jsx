import React, { StrictMode } from 'react'
import ReactDOM from 'react-dom/client'
import { BrowserRouter } from 'react-router-dom'
import { createTheme } from '@mui/material/styles'
import './index.css'
import App from './App.jsx'
import { ThemeProvider } from '@emotion/react'


const theme = createTheme({
  palette: {
    primary: {
      light: '#2196f3',
      main: '#3f51b5',
      dark: '#1a237e',
      contrastText: '#fff',
    },
    secondary: {
      light: '#1976d2',
      main: '#2196f3',
      dark: '#0d47a1',
      contrastText: '#000',
    },
  },
});
ReactDOM.createRoot(document.getElementById('root')).render(
  <ThemeProvider theme={theme}>
  <BrowserRouter>
    <StrictMode>
      <App />
    </StrictMode>
  </BrowserRouter>
  </ThemeProvider>
)

