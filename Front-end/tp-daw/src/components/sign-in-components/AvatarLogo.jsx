import Avatar from '@mui/material/Avatar';
import Icon from '../../assets/Icon.webp';

function AvatarLogo(){
    return(
        <>
        <Avatar sx={{ width: '150px', height: '150px', margin: 1, alignSelf: 'center' }} src={Icon}/>
        </>
    )
}

export default AvatarLogo
