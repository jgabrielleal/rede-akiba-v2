import { useQuery } from '@tanstack/react-query';
import { 
    getProgramas,
    getPrograma
} from './api';

export function useProgramas(){
    return useQuery({
        queryKey: ['Programas'],
        queryFn: getProgramas
    })
}

export function usePrograma(slug: string){
    return useQuery({
        queryKey: ['Programa'],
        queryFn: () => getPrograma(slug),
        enabled: !!slug
    })
}