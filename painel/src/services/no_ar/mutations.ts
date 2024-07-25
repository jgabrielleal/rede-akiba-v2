import { useMutation, useQueryClient } from '@tanstack/react-query';
import { NoArTypes } from './types';
import {
    createRegistroNoAr,
    updateRegistroNoAr,
    deleteRegistroNoAr
} from './api';

export function useCreateRegistroNoAr(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: NoArTypes) => createRegistroNoAr(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar um registro:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['NoAr'] });
        }
    })
}

export function useUpdateRegistroNoAr(id: string, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: NoArTypes) => updateRegistroNoAr(id, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar um registro:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['NoAr', {id}] });
        }
    })
}

export function useDeleteRegistroNoAr(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: string) => deleteRegistroNoAr(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover um registro:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['NoAr'] });
        }
    })
}