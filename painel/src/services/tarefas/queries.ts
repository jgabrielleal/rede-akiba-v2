import { useQuery } from '@tanstack/react-query';
import {
    getTarefas,
    getTarefa
} from './api';

export function useTarefas(){
    return useQuery({
        queryKey: ['Tarefas'],
        queryFn: getTarefas,
    })
}

export function useTarefa(id: number){
    return useQuery({
        queryKey: ['Tarefas'],
        queryFn: () => getTarefa(id),
        enabled: !!id
    })
}