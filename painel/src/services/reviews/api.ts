import { api } from "@services/axios.default"
import { ReviewsTypes } from "./types"

export async function getReviews(pageParam: number){
    try{
        const response = await api.get('/reviews?page=' + pageParam);
        return response.data;
    }catch(error: any){
        throw error;
    }
}

export async function getReview(slug: string){
    try{
        const response = await api.get(`/reviews/${slug}`);
        return response.data;
    }catch(error: any){
        throw error;
    }
}

export async function createReview(data: ReviewsTypes){
    try{
        const response = await api.post('/reviews', data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function updateReview(slug: string, data: ReviewsTypes){
    try{
        const response = await api.put(`/reviews/update/${slug}`, data);
        return response;
    }catch(error: any){
        throw error;
    }
}

export async function removeReview(id: number){
    try{
        const response = await api.delete(`/reviews/delete/${id}`);
        return response;
    }catch(error: any){
        throw error;
    }
}