import { useMutation, useQueryClient } from '@tanstack/react-query';
import { EventosTypes } from './types';
import { 
    createEvento,
    updateEvento,
    removeEvento
} from './api';

export function useCreateEvento(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: EventosTypes) => createEvento(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar um evento:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Eventos'] });
        }
    })
}

export function useUpdateEvento(slug: string, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: EventosTypes) => updateEvento(slug, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar um evento:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Eventos', {slug}] });
        }
    })
}

export function useRemoveEvento(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removeEvento(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover um evento:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Eventos'] });
        }
    })
}