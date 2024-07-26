import { api } from "@services/axios.default";
import { MateriasTypes } from "./types";

export async function getMaterias(){
    try{
        const response = await api.get('/materias');
        return response.data;
    }catch(error:any){
        throw error;
    }
}

export async function getMateria(slug: string){
    try{
        const response = await api.get(`/mataerias/${slug}`);
        return response.data;
    }catch(error:any){
        throw error;
    }
}

export async function createMateria(data: MateriasTypes){
    try{
        const response = await api.post('/materias', data);
        return response.data;
    }catch(error:any){
        throw error;
    }
}

export async function updateMateria(slug: string, data: MateriasTypes){
    try{
        const response = await api.put(`/materias/update/${slug}`, data);
        return response.data;
    }catch(error:any){
        throw error;
    }
}

export async function removeMateria(id: number){
    try{
        const response = await api.delete(`/materias/delete/${id}`);
        return response.data;
    }catch(error:any){
        throw error;
    }
}