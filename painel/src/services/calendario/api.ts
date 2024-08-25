import { api } from "@services/axios.default"
import { CalendarioTypes } from "./types"

export async function getEventosCalendario(){
    try{
        const response = await api.get('/calendario')
        return response.data
    }catch(error:any){
        throw error
    }
}

export async function getEventoCalendario(id: number){
    try{
        const response = await api.get(`/calendario/${id}`)
        return response
    }catch(error:any){
        throw error
    }
}

export async function createEventoCalendario(data: CalendarioTypes){
    try{
        const response = await api.post('/calendario', data)
        return response
    }catch(error:any){
        throw error
    }
}

export async function updateEventoCalendario(id: number, data: CalendarioTypes){
    try{
        const response = await api.patch(`/calendario/update/${id}`, data)
        return response
    }catch(error:any){
        throw error
    }
}

export async function removeEventoCalendario(id: number){
    try{
        const response = await api.delete(`/calendario/delete/${id}`)
        return response
    }catch(error:any){
        throw error
    }
}