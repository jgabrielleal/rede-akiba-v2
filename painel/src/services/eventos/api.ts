import { api } from "@services/axios.default"
import { EventosTypes } from "./types"

export async function getEventos(){
    try{
        const response = await api.get('/eventos');
        return response.data;
    }catch(error){
        throw error;
    }
}

export async function getEvento(slug: string){
    try{
        const response = await api.get(`/eventos/${slug}`);
        return response.data;
    }catch(error){
        throw error;
    }
}

export async function createEvento(data: EventosTypes){
    try{
        const response = await api.post('/eventos', data);
        return response.data;
    }catch(error){
        throw error;
    }
}

export async function updateEvento(slug: string, data: EventosTypes){
    try{
        const response = await api.put(`/eventos/update/${slug}`, data);
        return response.data;
    }catch(error){
        throw error;
    }
}

export async function removeEvento(id: number){
    try{
        const response = await api.delete(`/eventos/delete/${id}`);
        return response.data;
    }catch(error){
        throw error;
    }
}