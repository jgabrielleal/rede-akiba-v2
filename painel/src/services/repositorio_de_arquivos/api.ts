import { api } from "@services/axios.default"
import { RepositorioDeArquivosTypes } from "./types"

export async function getArquivos(){
    try{
        const response = await api.get('/repositoriodearquivos')
        return response.data
    }catch(error){
        throw error
    }
}

export async function getArquivo(id: number){
    try{
        const response = await api.get(`/repositoriodearquivos/${id}`)
        return response.data
    }catch(error){
        throw error
    }
}

export async function createArquivo(data: RepositorioDeArquivosTypes){
    try{
        const response = await api.post('/repositoriodearquivos', data)
        return response.data
    }catch(error){
        throw error
    }
}

export async function updateArquivo(id: number, data: RepositorioDeArquivosTypes){
    try{
        const response = await api.patch(`/repositoriodearquivos/update/${id}`, data)
        return response.data
    }catch(error){
        throw error
    }
}

export async function removeArquivo(id: number){
    try{
        const response = await api.delete(`/repositoriodearquivos/delete/${id}`)
        return response.data
    }catch(error){
        throw error
    }
}