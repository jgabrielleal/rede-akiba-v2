import axios from "axios"

export const api = axios.create({
    baseURL: 'http://127.0.0.1:8000',
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('aki-token')}`
    }
})