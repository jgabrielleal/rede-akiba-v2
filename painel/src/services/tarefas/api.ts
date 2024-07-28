import { api } from "@services/axios.default"
import { TarefasTypes } from "./types"

export async function getTarefas(){
    try{
        const response = await api.get('/tarefas');
        return response.data;
    }catch(error){
        throw error
    }
}

export async function getTarefa(id: number){
    try{
        const response = await api.get(`/tarefas/${id}`);
        return response.data;
    }catch(error){
        throw error
    }
}

export async function createTarefa(data: TarefasTypes){
    try{
        const response = await api.post('/tarefas', data);
        return response.data;
    }catch(error){
        throw error
    }
}

export async function updateTarefa(id: number, data: TarefasTypes){
    try{
        const response = await api.put(`/tarefas/update/${id}`, data);
        return response.data;
    }catch(error){
        throw error
    }
}

export async function removeTarefa(id: number){
    try{
        const response = await api.delete(`/tarefas/delete/${id}`);
        return response.data;
    }catch(error){
        throw error
    }
}