import './App.css'
import { Routes, Route } from 'react-router-dom'
import SignInPage from './pages/SignInPage.jsx'
import Home from './pages/Home.jsx'
import Users from './pages/Users.jsx'
import Ventas from './pages/Ventas.jsx'


function App() {
  return (
    <>
      <Routes>
        <Route path="/" element={<SignInPage />} />
        <Route path="/home" element={<Home />} />
        <Route path="/users" element={<><Home/><Users/></>}/>
        <Route path="/ventas" element={<><Home/><Ventas/></>}/>
        <Route path="/sign-in-page" element={<SignInPage />} />
      </Routes>
    </>
  )
}

export default App