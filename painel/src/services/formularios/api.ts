import { api } from "@services/axios.default";
import { FormulariosTypes } from "./types";

export async function getFormularios(){
    try{
        const response = await api.get('/formularios');
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function getFormulario(id: string){
    try{
        const response = await api.get(`/formularios/${id}`);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function createFormulario(data: FormulariosTypes){
    try{
        const response = await api.post('/formularios', data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function updateFormulario(id: number, data: FormulariosTypes){
    try{
        const response = await api.put(`/formularios/update/${id}`, data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function removeFormulario(id: number){
    try{
        const response = await api.delete(`/formularios/delete/${id}`);
        return response;
    }catch(error: any){
        throw error;
    }
}