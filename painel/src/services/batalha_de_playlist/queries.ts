import { useQuery } from '@tanstack/react-query';
import { 
    getBatalhaDePlaylist,
} from './api';

export function useBatalhaDePlaylist(){
    return useQuery({
        queryKey: ['BatalhaDePlaylist'],
        queryFn: getBatalhaDePlaylist,
    })
}