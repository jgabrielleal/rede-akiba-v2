import { api } from "@services/axios.default"
import { AvisosParaEquipeTypes } from "./types"

export async function getAvisosParaEquipe(){
    try{
        const response = await api.get('/avisosparaequipe')
        return response.data
    }catch(error){
        throw error
    }
}

export async function getAvisoParaEquipe(id: number){
    try{
        const response = await api.get(`/avisosparaequipe/${id}`)
        return response.data
    }catch(error){
        throw error
    }
}

export async function createAvisoParaEquipe(data: AvisosParaEquipeTypes){
    try{
        const response = await api.post('/avisosparaequipe', data)
        return response.data
    }catch(error){
        throw error
    }
}

export async function updateAvisoParaEquipe(id: number, data: AvisosParaEquipeTypes){
    try{
        const response = await api.patch(`/avisosparaequipe/update/${id}`, data)
        return response.data
    }catch(error){
        throw error
    }
}

export async function removeAvisoParaEquipe(id: number){
    try{
        const response = await api.delete(`/avisosparaequipe/delete/${id}`)
        return response.data
    }catch(error){
        throw error
    }
}

