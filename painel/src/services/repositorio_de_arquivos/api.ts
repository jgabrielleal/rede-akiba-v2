import { api } from "@services/axios.default"
import { RepositorioDeArquivosTypes } from "./types"

export async function getArquivos(){
    try{
        const response = await api.get('/repositoriodearquivos')
        return response
    }catch(error:any){
        throw error
    }
}

export async function getArquivo(id: number){
    try{
        const response = await api.get(`/repositoriodearquivos/${id}`)
        return response
    }catch(error:any){
        throw error
    }
}

export async function createArquivo(data: RepositorioDeArquivosTypes){
    try{
        const response = await api.post('/repositoriodearquivos', data)
        return response
    }catch(error:any){
        throw error
    }
}

export async function updateArquivo(id: number, data: RepositorioDeArquivosTypes){
    try{
        const response = await api.put(`/repositoriodearquivos/update/${id}`, data)
        return response
    }catch(error:any){
        throw error
    }
}

export async function removeArquivo(id: number){
    try{
        const response = await api.delete(`/repositoriodearquivos/delete/${id}`)
        return response
    }catch(error:any){
        throw error
    }
}