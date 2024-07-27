import { useQuery } from '@tanstack/react-query';
import {
    getVideosDoYoutube,
    getVideoDoYoutube
} from './api';

export function useVideosDoYoutube(){
    return useQuery({
        queryKey: ['Vídeos'],
        queryFn: getVideosDoYoutube,
    })
}

export function useVideoDoYoutube(id: number){
    return useQuery({
        queryKey: ['Vídeo', id],
        queryFn: () => getVideoDoYoutube(id),
        enabled: !!id
    })
}