import { useQuery } from '@tanstack/react-query';
import { 
    getFormularios,
    getFormulario
} from './api';

export function useFormularios(){
    return useQuery({
        queryKey: ['Formularios'],
        queryFn: getFormularios
    })
}

export function useFormulario(id: string){
    return useQuery({
        queryKey: ['Formulario', id],
        queryFn: () => getFormulario(id),
        enabled: !!id
    })
}