import * as React from 'react';
import { DataGrid } from '@mui/x-data-grid';
import Paper from '@mui/material/Paper';

const columns = [
  { field: 'id', headerName: 'ID', width: 70 },
  { field: 'firstName', headerName: 'Nombre', width: 200 },
  { field: 'lastName', headerName: 'Apellido', width: 200 },
  
  {
    field: 'age',
    headerName: 'Age',
    type: 'number',
    width: 90,
  },
  { field: 'email', headerName: 'Email', width: 250},
  {
    field: 'telefono',
    headerName: 'Telefono',
    width: 200,
  },
];

const rows = [
  { id: 1, lastName: 'Snow', firstName: 'Jon', age: 35, email: "", telefono: "" },
  { id: 2, lastName: 'Lannister', firstName: 'Cersei', age: 42, email: "", telefono: "" },
  { id: 3, lastName: 'Lannister', firstName: 'Jaime', age: 45, email: "", telefono: ""  },
  { id: 4, lastName: 'Stark', firstName: 'Arya', age: 16, email: "", telefono: ""  },
  { id: 5, lastName: 'Targaryen', firstName: 'Daenerys', age: null, email: "", telefono: ""  },
  { id: 6, lastName: 'Melisandre', firstName: null, age: 150, email: "", telefono: ""  },
  { id: 7, lastName: 'Clifford', firstName: 'Ferrara', age: 44, email: "", telefono: ""  },
  { id: 8, lastName: 'Frances', firstName: 'Rossini', age: 36, email: "", telefono: ""  },
  { id: 9, lastName: 'Roxie', firstName: 'Harvey', age: 65, email: "", telefono: ""  },
];

const paginationModel = { page: 0, pageSize: 5 };

export default function DataTable() {
  return (
    <Paper sx={{ height: 800, width: '100%' }}>
      <DataGrid
        rows={rows}
        columns={columns}
        initialState={{ pagination: { paginationModel } }}
        pageSizeOptions={[5, 10]}
        checkboxSelection
        sx={{ border: 0 }}
      />
    </Paper>
  );
}