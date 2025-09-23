import VentasList from '../components/ventas-components/VentasList';
import ContainerButtons from '../components/generals-components/ContainerButtons';
import Paper from '@mui/material/Paper';

function Ventas(){
    return(
         <>
        <Paper elevation={3} sx={{marginTop: 1, marginLeft: '15%', width: '84%'}}>
        <ContainerButtons buttonsName={['Anular ventas']}/>
        </Paper>
        <Paper elevation={3} sx={{marginTop: 1, marginLeft: '15%', width: '84%'}}>
        <VentasList />
        </Paper>
        </>
    )
}

export default Ventas