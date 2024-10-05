import { api } from '@services/axios.default'
import { TopDeMusicasTypes } from "./types";

export async function getTopDeMusicas(){
    try{
        const response = await api.get('/topdemusicas');
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function getPosicaoTopDeMusica(id: number){
    try{
        const response = await api.get(`/topdemusicas/${id}`);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function createPosicaoTopDeMusica(data: TopDeMusicasTypes){
    try{
        const response = await api.post('/topdemusicas', data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function updatePosicaoTopDeMusica(id: number, data: TopDeMusicasTypes){
    try{
        const response = await api.put(`/topdemusicas/update/${id}`, data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function removePosicaoTopDeMusica(id: number){
    try{
        const response = await api.delete(`/topdemusicas/delete/${id}`);
        return response;
    }catch(error: any){
        throw error;
    }
}