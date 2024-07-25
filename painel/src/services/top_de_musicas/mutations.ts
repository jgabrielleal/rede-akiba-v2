import { useMutation, useQueryClient } from '@tanstack/react-query';
import { TopDeMusicasTypes } from './types';
import {
    createPosicaoTopDeMusica,
    removePosicaoTopDeMusica,
    updatePosicaoTopDeMusica
} from './api';

export function useCreatePosicaoTopDeMusica(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: TopDeMusicasTypes) => createPosicaoTopDeMusica(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar um top de música:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['TopDeMusicas'] });
        }
    })
}

export function useUpdatePosicaoTopDeMusica(id: number, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: TopDeMusicasTypes) => updatePosicaoTopDeMusica(id, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar um top de música:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['TopDeMusicas', {id}] });
        }
    })
}

export function useRemovePosicaoTopDeMusica(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removePosicaoTopDeMusica(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover um top de música:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['TopDeMusicas'] });
        }
    })
}