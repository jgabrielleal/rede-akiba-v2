import { useQuery } from '@tanstack/react-query';
import {
    getArquivo,
    getArquivos,
} from './api';

export function useArquivos(){
    return useQuery({
        queryKey: ['Arquivos'],
        queryFn: getArquivos
    })
}

export function useArquivo(id: number){
    return useQuery({
        queryKey: ['Arquivo', id],
        queryFn: () => getArquivo(id),
        enabled: !!id
    })
}