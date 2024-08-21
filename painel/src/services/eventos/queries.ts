import { useQuery } from '@tanstack/react-query';
import {
    getEventos,
    getEvento
} from './api';

export function useEventos(){
    return useQuery({
        queryKey: ['Eventos'],
        queryFn: getEventos
    })
}

export function useEvento(slug: string){
    return useQuery({
        queryKey: ['Evento'],
        queryFn: () => getEvento(slug),
        enabled: !!slug
    })
}