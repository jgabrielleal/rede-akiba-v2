import { useQuery } from '@tanstack/react-query';
import {
    getAvisosParaEquipe,
    getAvisoParaEquipe,
} from './api';

export function useAvisosParaEquipe(){
    return useQuery({
        queryKey: ['AvisosParaEquipe'],
        queryFn: getAvisosParaEquipe,
    })
}

export function useAvisoParaEquipe(id: number){
    return useQuery({
        queryKey: ['AvisosParaEquipe'],
        queryFn: () => getAvisoParaEquipe(id),
    })
}