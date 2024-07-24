import { api } from '@services/axios.default'
import { NoArTypes } from './types'

export async function getRegistrosNoAr(){
    try{
        const response = await api.get('/noar')
        return response.data
    }catch(error){
        throw error
    }
}

export async function getRegistroNoAr(id: string){
    try{
        const response = await api.get(`/noar/${id}`)
        return response.data
    }catch(error){
        throw error
    }
}

export async function createRegistroNoAr(data: NoArTypes){
    try{
        const response = await api.post('/noar', data)
        return response.data
    }catch(error){
        throw error
    }
}

export async function updateRegistroNoAr(id: string, data: NoArTypes){
    try{
        const response = await api.put(`/noar/update/${id}`, data)
        return response.data
    }catch(error){
        throw error
    }
}

export async function deleteRegistroNoAr(id: string){
    try{
        const response = await api.delete(`/noar/update/${id}`)
        return response.data
    }catch(error){
        throw error
    }
}