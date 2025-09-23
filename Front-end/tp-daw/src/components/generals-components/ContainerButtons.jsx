import React from 'react'
import Button from '@mui/material/Button'
import Paper from '@mui/material/Paper';

const divStyle = {
    margin: 10,
    padding: 10,
    display: 'flex',
    flexDirection: 'row',
    gap: 50,
    justifyContent: 'center',
    alignItems: 'center'
}



function ContainerButtons({buttonsName}) {
  return (
    <div style={divStyle}>
        {buttonsName?.map((name, index) => (
            <Paper key={index} elevation={3} sx={{}}>
            <Button variant="contained" color="primary">{name}</Button>
        </Paper>
        ))}
    </div>
  )
}

export default ContainerButtons
