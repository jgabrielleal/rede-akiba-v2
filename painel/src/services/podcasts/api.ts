import { api } from '@services/axios.default'
import { PodcastsTypes } from "./types";

export async function getPodcasts(){
    try{
        const response = await api.get('/podcasts');
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function getPodcast(slug: string){
    try{
        const response = await api.get(`/podcasts/${slug}`);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function createPodcast(data: PodcastsTypes){
    try{
        const response = await api.post('/podcasts', data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function updatePodcast(slug: string, data: PodcastsTypes){
    try{
        const response = await api.put(`/podcasts/update/${slug}`, data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function removePodcast(id: number){
    try{
        const response = await api.delete(`/podcasts/delete/${id}`);
        return response;
    }catch(error: any){
        throw error;
    }
}