import { useQuery } from '@tanstack/react-query';
import { 
    getMaterias,
    getMateria
} from './api';

export function useMaterias(){
    return useQuery({
        queryKey: ['Materias'],
        queryFn: getMaterias
    })
}

export function useMateria(slug: string){
    return useQuery({
        queryKey: ['Materia', slug],
        queryFn: () => getMateria(slug),
        enabled: !!slug
    })
}