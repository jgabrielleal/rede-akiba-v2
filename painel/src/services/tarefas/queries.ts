import { useQuery } from '@tanstack/react-query';
import {
    getTarefas,
    getTarefa
} from './api';

export function useTopDeMusicas(){
    return useQuery({
        queryKey: ['Tarefas'],
        queryFn: getTarefas,
    })
}

export function useTopDeMusica(id: number){
    return useQuery({
        queryKey: ['Tarefas', id],
        queryFn: () => getTarefa(id),
        enabled: !!id
    })
}