import NavBar from "../components/home-components/NavBar.jsx";
import { Outlet } from "react-router-dom";
import "./styles/home.css";

function Home() {
  return (
    <>
      <div className="home-container">
        <NavBar />
        {/* Outlet renderiza las rutas hijas (usuarios, ventas) */}
        <section id="section-main">
          <Outlet />
        </section>
      </div>
    </>
  );
}

export default Home;
