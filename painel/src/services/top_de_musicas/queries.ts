import { useQuery } from '@tanstack/react-query';
import { 
    getTopDeMusicas,
    getPosicaoTopDeMusica
} from './api';

export function useTopDeMusicas(){
    return useQuery({
        queryKey: ['TopDeMusicas'],
        queryFn: getTopDeMusicas,
    })
}

export function useTopDeMusica(id: number){
    return useQuery({
        queryKey: ['TopDeMusica', id],
        queryFn: () => getPosicaoTopDeMusica(id),
        enabled: !!id
    })
}