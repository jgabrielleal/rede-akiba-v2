import { api } from "@services/axios.default"
import { VideosDoYoutubeType } from "./types"

export async function getVideosDoYoutube(){
    try{
        const response = await api.get('/videosdoyoutube');
        return response.data;
    }catch(error: any){
        throw error;
    }
}

export async function getVideoDoYoutube(id: number){
    try{
        const response = await api.get(`/videosdoyoutube/${id}`);
        return response.data;
    }catch(error: any){
        throw error;
    }
}

export async function createVideoDoYoutube(data: VideosDoYoutubeType){
    try{
        const response = await api.post('/videosdoyoutube', data);
        return response.data;
    }catch(error: any){
        throw error;
    }
}

export async function updateVideoDoYoutube(id: number, data: VideosDoYoutubeType){
    try{
        const response = await api.patch(`/videosdoyoutube/update/${id}`, data);
        return response.data;
    }catch(error: any){
        throw error;
    }
}

export async function removeVideoDoYoutube(id: number){
    try{
        const response = await api.delete(`/videosdoyoutube/delete/${id}`);
        return response.data;
    }catch(error: any){
        throw error;
    }
}