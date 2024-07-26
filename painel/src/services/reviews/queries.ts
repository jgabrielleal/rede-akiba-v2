import { useQuery } from '@tanstack/react-query';
import { 
    getReview,
    getReviews,
} from './api';

export function useReviews(){
    return useQuery({
        queryKey: ['Reviews'],
        queryFn: getReviews
    })
}

export function useReview(slug: string){
    return useQuery({
        queryKey: ['Review', slug],
        queryFn: () => getReview(slug),
        enabled: !!slug
    })
}