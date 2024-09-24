import { useQuery, useInfiniteQuery } from '@tanstack/react-query';
import { 
    getReview,
    getReviews,
} from './api';

export function useReviews(){
    return useInfiniteQuery({
        queryKey: ['ReviewsInfinite'],
        queryFn: ({ pageParam = 1 }) => getReviews(pageParam),
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


export function useReview(slug: string){
    return useQuery({
        queryKey: ['Reviews'],
        queryFn: () => getReview(slug),
        enabled: !!slug
    })
}