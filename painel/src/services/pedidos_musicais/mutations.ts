import { useMutation, useQueryClient } from '@tanstack/react-query';
import { PedidosMusicaisTypes } from './types';
import { 
    createPedidoMusical,
    updatePedidoMusical,
    removePedidoMusical
} from './api';

export function useCreatePedidoMusical(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: PedidosMusicaisTypes) => createPedidoMusical(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar um pedido musical:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['PedidosMusicais'] });
        }
    })
}

export function useUpdatePedidoMusical(id: number, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: PedidosMusicaisTypes) => updatePedidoMusical(id, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar um pedido musical:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['PedidosMusicais'] });
        }
    })
}

export function useRemovePedidoMusical(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removePedidoMusical(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover um pedido musical:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['PedidosMusicais'] });
        }
    })
}