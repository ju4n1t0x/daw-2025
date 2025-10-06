import "./App.css";
import SignInPage from "./pages/SignInPage.jsx";
import Home from "./pages/Home.jsx";
import Users from "./pages/Users.jsx";
import Ventas from "./pages/Ventas.jsx";
import { Routes, Route } from "react-router-dom";

function App() {
  return (
    <>
      <Routes>
        <Route path="/" element={<SignInPage />} />
        <Route path="/home" element={<Home />}>
          <Route path="usuarios" element={<Users />} />
          <Route path="ventas" element={<Ventas />} />
        </Route>
      </Routes>
    </>
  );
}

export default App;
