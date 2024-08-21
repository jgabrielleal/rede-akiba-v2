import { useQuery } from '@tanstack/react-query';
import { 
    getPodcasts,
    getPodcast
} from './api';

export function usePodcasts(){
    return useQuery({
        queryKey: ['Programas'],
        queryFn: getPodcasts,
    })
}

export function usePodcast(slug: string){
    return useQuery({
        queryKey: ['Programa'],
        queryFn: () => getPodcast(slug),
        enabled: !!slug
    })
}