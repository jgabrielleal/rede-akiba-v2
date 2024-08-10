import { api } from '@services/axios.default'
import { ProgramasTypes } from './types';

export async function getProgramas(){
    try{
        const response = await api.get('/programas');
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function getPrograma(slug: string){
    try{
        const response = await api.get(`/programas/${slug}`);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function createPrograma(data: ProgramasTypes){
    try{
        const response = await api.post('/programas', data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function updatePrograma(slug: string, data: ProgramasTypes){
    try{
        const response = await api.patch(`/programas/update/${slug}`, data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function removePrograma(slug: string){
    try{
        const response = await api.delete(`/programas/delete/${slug}`);
        return response;
    }catch(error: any){
        throw error;
    }
}