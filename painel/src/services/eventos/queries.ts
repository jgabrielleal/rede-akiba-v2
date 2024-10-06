import { useQuery, useInfiniteQuery } from '@tanstack/react-query';
import {
    getEventos,
    getEvento
} from './api';

export function useEventos(){
    return useInfiniteQuery({
        queryKey: ['EventosInfinite'],
        queryFn: ({ pageParam = 1 }) => getEventos(pageParam),
        initialPageParam: 1,
        getNextPageParam: (lastPage) => {
            if (lastPage && lastPage.next_page_url) {
                return lastPage.current_page + 1;
            }
            return undefined;
        },
        getPreviousPageParam: (firstPage) => {
            if (firstPage && firstPage.prev_page_url) {
                return firstPage.current_page - 1;
            }
            return undefined;
        },
    });
}


export function useEvento(slug: string){
    return useQuery({
        queryKey: ['Eventos'],
        queryFn: () => getEvento(slug),
        enabled: !!slug
    })
}