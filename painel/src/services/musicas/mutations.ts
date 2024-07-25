import { useMutation, useQueryClient } from '@tanstack/react-query';
import { MusicasTypes } from './types';
import { 
    createMusica,
    updateMusica,
    removeMusica
} from './api';

export function useCreateMusica(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: MusicasTypes) => createMusica(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar uma música:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Musicas'] });
        }
    })
}

export function useUpdateMusica(id: number, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: MusicasTypes) => updateMusica(id, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar uma música:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Musicas', {id}] });
        }
    })
}

export function useRemoveMusica(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removeMusica(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover uma música:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Musicas'] });
        }
    })
}