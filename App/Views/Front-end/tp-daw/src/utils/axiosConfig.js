import axios from 'axios';

axios.defaults.baseURL = "http://localhost/daw2025/TP/Public";
axios.defaults.withCredentials = true; 

axios.interceptors.request.use((config) =>{
    return config;
},
(error) =>{
    return Promise.reject(error);
}
);
axios.interceptors.response.use((response) =>{
    return response;
},
(error) => {
    if (error.response?.status === 401){
        sessionStorage.clear();
        window.location.href = '/';
    }
    return Promise.reject(error);

});
export default axios;