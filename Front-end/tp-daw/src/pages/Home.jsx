import NavBar from '../components/home-components/NavBar.jsx'
import {Outlet} from 'react-router-dom';
import './styles/home.css'

function Home(){
    return(
        <>
        <NavBar/>
        
        <Outlet />
        
        
        </>
    )
}

export default Home;