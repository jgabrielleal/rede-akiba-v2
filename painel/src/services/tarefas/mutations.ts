import { useMutation, useQueryClient } from '@tanstack/react-query';
import { TarefasTypes } from './types';
import {
    createTarefa,
    removeTarefa,
    updateTarefa
} from './api';

export function useCreateTarefa(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: TarefasTypes) => createTarefa(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar uma tarefa:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Tarefas'] });
        }
    })
}

export function useUpdateTarefa(id: number, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: TarefasTypes) => updateTarefa(id, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar uma tarefa:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Tarefas'] });
        }
    })
}

export function useRemoveTarefa(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removeTarefa(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover uma tarefa:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Tarefas'] });
        }
    })
}