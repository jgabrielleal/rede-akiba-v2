import { api } from "@services/axios.default"
import { BatalhaDePlaylistTypes } from "./types"

export async function getBatalhaDePlaylist(){
    try{
        const response = await api.get('/batalhadeplaylist')
        return response
    }catch(error:any){
        throw error;
    }
}

export async function updateBatalhaDePlaylist(data: BatalhaDePlaylistTypes){
    try{
        const response = await api.patch('/batalhadeplaylist', data)
        return response
    }catch(error:any){
        throw error;
    }
}