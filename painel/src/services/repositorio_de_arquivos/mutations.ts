import { useMutation, useQueryClient } from '@tanstack/react-query';
import { RepositorioDeArquivosTypes } from './types';
import {
    createArquivo,
    removeArquivo,
    updateArquivo
} from './api';

export function useCreateArquivo(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: RepositorioDeArquivosTypes) => createArquivo(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar um arquivo:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['RepositorioDeArquivos'] });
        }
    })
}

export function useUpdateArquivo(id: number, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: RepositorioDeArquivosTypes) => updateArquivo(id, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar um arquivo:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['RepositorioDeArquivos', {id}] });
        }
    })
}

export function useRemoveArquivo(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removeArquivo(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover um arquivo:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['RepositorioDeArquivos'] });
        }
    })
}