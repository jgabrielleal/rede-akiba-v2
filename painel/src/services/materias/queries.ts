import { useQuery, useInfiniteQuery } from '@tanstack/react-query';
import {
    getMaterias,
    getMateria
} from './api';


export function useMaterias() {
    return useInfiniteQuery({
        queryKey: ['MateriasInfinite'],
        queryFn: ({ pageParam = 1 }) => getMaterias(pageParam),
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

export function useMateria(slug: string) {
    return useQuery({
        queryKey: ['Materias'],
        queryFn: () => getMateria(slug),
        enabled: !!slug
    })
}