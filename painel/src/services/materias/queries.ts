import { useQuery, useInfiniteQuery } from '@tanstack/react-query';
import { 
    getMaterias,
    getMateria
} from './api';


export function useMaterias() {
    return useInfiniteQuery({
        queryKey: ['Materias'],
        queryFn: ({ pageParam = 1 }) => getMaterias(pageParam),
        initialPageParam: 1,
        getNextPageParam: (lastPage) => {
            return lastPage.next_page_url ? lastPage.current_page + 1 : undefined;
        },
        getPreviousPageParam: (firstPage) => {
            return firstPage.prev_page_url ? firstPage.current_page - 1 : undefined;
        },
        maxPages: 3,
    });
}

export function useMateria(slug: string){
    return useQuery({
        queryKey: ['Materia'],
        queryFn: () => getMateria(slug),
        enabled: !!slug
    })
}