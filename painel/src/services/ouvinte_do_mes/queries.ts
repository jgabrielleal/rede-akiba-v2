import { useQuery } from '@tanstack/react-query';
import { 
    getOuvinteDoMes
} from './api';

export function useOuvinteDoMes(){
    return useQuery({
        queryKey: ['OuvinteDoMes'],
        queryFn: getOuvinteDoMes
    })
}