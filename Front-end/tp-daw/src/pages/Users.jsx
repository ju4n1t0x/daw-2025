import UsersTable from '../components/users-components/UsersTable';
import ContainerButtons from '../components/generals-components/ContainerButtons';
import Paper from '@mui/material/Paper';



function Users(){
    return(
        <>
        <Paper elevation={3} sx={{marginTop: 1, marginLeft: '15%', width: '84%'}}>
        <ContainerButtons buttonsName={['Agregar usuario', 'Eliminar usuario', 'Modificar usuario']}/>
        </Paper>
        <Paper elevation={3} sx={{marginTop: 1, marginLeft: '15%', width: '84%'}}>
        <UsersTable />
        </Paper>
        </>
    )
    
}   

export default Users