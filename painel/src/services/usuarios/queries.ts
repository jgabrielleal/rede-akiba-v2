import { useQuery } from '@tanstack/react-query';
import { 
    getUsuarios,
    getUsuario
} from './api';

export function useUsuarios(){
    return useQuery({
        queryKey: ['Usuarios'],
        queryFn: getUsuarios
    })
}

export function useUsuario(slug: string){
    return useQuery({
        queryKey: ['Usuario', slug],
        queryFn: () => getUsuario(slug),
        enabled: !!slug
    })
}