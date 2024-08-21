import { useQuery } from '@tanstack/react-query';
import {
    getRegistrosNoAr,
    getRegistroNoAr
} from './api';

export function useRegistrosNoAr(){
    return useQuery({
        queryKey: ['NoAr'],
        queryFn: getRegistrosNoAr
    })
}

export function useRegistroNoAr(id: string){
    return useQuery({
        queryKey: ['NoAr'],
        queryFn: () => getRegistroNoAr(id),
        enabled: !!id
    })
}