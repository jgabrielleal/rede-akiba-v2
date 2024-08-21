import { useQuery } from '@tanstack/react-query';
import { 
    getEventosCalendario,
    getEventoCalendario,
} from './api';

export function useEventosCalendario(){
    return useQuery({
        queryKey: ['EventosCalendario'],
        queryFn: getEventosCalendario,
    })
}

export function useEventoCalendario(id: number){
    return useQuery({
        queryKey: ['EventosCalendario'],
        queryFn: () => getEventoCalendario(id),
    })
}