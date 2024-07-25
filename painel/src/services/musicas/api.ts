import { api } from '@services/axios.default'
import { MusicasTypes } from './types';

export async function getMusicas(){
   try{
        const response = await api.get('/musicas');
        return response.data;
   }catch(error:any){
       throw error;
   }
}

export async function getMusica(id: number){
    try{
        const response = await api.get(`/musicas/${id}`);
        return response.data;
    }catch(error:any){
        throw error;
    }
}

export async function createMusica(data: MusicasTypes){
    try{
        const response = await api.post('/musicas', data);
        return response.data;
    }catch(error:any){
        throw error;
    }
}

export async function updateMusica(id: number, data: MusicasTypes){
    try{
        const response = await api.patch(`/musicas/update/${id}`, data);
        return response.data;
    }catch(error:any){
        throw error;
    }
}

export async function removeMusica(id: number){
    try{
        const response = await api.delete(`/musicas/delete/${id}`);
        return response.data;
    }catch(error:any){
        throw error;
    }
}