import { api } from '@services/axios.default'
import { PedidosMusicaisTypes } from './types';

export async function getPedidosMusicais(){
   try{
        const response = await api.get('/pedidosmusicais');
        return response.data;
   }catch(error:any){
       throw error;
   }
}

export async function getPedidoMusical(id: number){
    try{
        const response = await api.get(`/pedidosmusicais/${id}`);
        return response.data;
    }catch(error:any){
        throw error;
    }
}

export async function createPedidoMusical(data: PedidosMusicaisTypes){
    try{
        const response = await api.post('/pedidosmusicais', data);
        return response.data;
    }catch(error:any){
        throw error;
    }
}

export async function updatePedidoMusical(id: number, data: PedidosMusicaisTypes){
    try{
        const response = await api.patch(`/pedidosmusicais/update/${id}`, data);
        return response.data;
    }catch(error:any){
        throw error;
    }
}

export async function removePedidoMusical(id: number){
    try{
        const response = await api.delete(`/pedidosmusicais/delete/${id}`);
        return response.data;
    }catch(error:any){
        throw error;
    }
}