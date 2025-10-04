import './App.css'
import SignInPage from './pages/SignInPage.jsx'
import Home from './pages/Home.jsx'
import { Routes, Route } from 'react-router-dom'

function App() {
  return (
    <>
      <Routes>
        <Route path="/" element={<SignInPage />} />
        <Route path="/home" element={<Home />} />
      </Routes>
    </>
  )
}

export default App