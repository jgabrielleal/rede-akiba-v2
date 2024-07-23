import { useQuery } from '@tanstack/react-query';
import { Logado } from './api';

export function useLogado(token: string){
    return useQuery({
        queryKey: ['Login'],
        queryFn: () => Logado(token),
        enabled: !!token
    })
}