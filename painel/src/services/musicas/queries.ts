import { useQuery } from '@tanstack/react-query';
import {
    getMusicas,
    getMusica
} from './api';

export function useMusicas(){
    return useQuery({
        queryKey: ['Musicas'],
        queryFn: getMusicas
    })
}

export function useMusica(id: number){
    return useQuery({
        queryKey: ['Musica'],
        queryFn: () => getMusica(id),
        enabled: !!id
    })
}