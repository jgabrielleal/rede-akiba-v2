import { api } from "@services/axios.default";
import { OuvinteDoMesTypes } from "./types";

export async function getOuvinteDoMes(){
    try{
        const response = await api.get('/ouvintedomes');
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function updateOuvinteDoMes(data: OuvinteDoMesTypes){
    try{
        const response = await api.put('/ouvintedomes', data);
        return response;
    }catch(error: any){
        throw error;
    }
}