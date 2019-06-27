import axios from 'axios';

const api = axios.create({
  baseURL: 'http://192.168.43.106:8090/api',
});

export default api;
