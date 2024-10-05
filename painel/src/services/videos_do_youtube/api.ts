import { api } from "@services/axios.default"
import { VideosDoYoutubeType } from "./types"

export async function getVideosDoYoutube(){
    try{
        const response = await api.get('/videosdoyoutube');
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function getVideoDoYoutube(id: number){
    try{
        const response = await api.get(`/videosdoyoutube/${id}`);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function createVideoDoYoutube(data: VideosDoYoutubeType){
    try{
        const response = await api.post('/videosdoyoutube', data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function updateVideoDoYoutube(id: number, data: VideosDoYoutubeType){
    try{
        const response = await api.put(`/videosdoyoutube/update/${id}`, data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function removeVideoDoYoutube(id: number){
    try{
        const response = await api.delete(`/videosdoyoutube/delete/${id}`);
        return response;
    }catch(error: any){
        throw error;
    }
}