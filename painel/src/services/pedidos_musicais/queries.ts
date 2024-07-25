import { useQuery } from '@tanstack/react-query';
import { 
    getPedidosMusicais,
    getPedidoMusical
} from './api';

export function usePedidosMusicais(){
    return useQuery({
        queryKey: ['PedidosMusicais'],
        queryFn: getPedidosMusicais
    })
}

export function usePedidoMusical(id: number){
    return useQuery({
        queryKey: ['PedidoMusical', id],
        queryFn: () => getPedidoMusical(id),
        enabled: !!id
    })
}