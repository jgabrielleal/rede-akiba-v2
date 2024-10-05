import { api } from '@services/axios.default'
import { UsuarioType } from '@services/usuarios/types'

export async function getUsuarios(){
    try{
        const response = await api.get('/usuarios')
        return response.data
    }catch(error: any){
        throw error
    }
}

export async function getUsuario(slug: string){
    try{
        const response = await api.get(`/usuarios/${slug}`);
        return response.data
    }catch(error: any){
        throw error
    }
}

export async function createUsuario(data: UsuarioType){
    try{
        const response = await api.post('/usuarios', data);
        return response.data
    }catch(error: any){
        throw error
    }
}

export async function updateUsuario(slug: string, data: UsuarioType ){
    try{
        const response = await api.put(`/usuarios/update/${slug}`, data);
        return response.data
    }catch(error: any){
        throw error
    }
}

export async function removeUsuario(id: number){
    try{
        const response = await api.delete(`/usuarios/delete/${id}`);
        return response.data
    }catch(error: any){
        throw error
    }
}