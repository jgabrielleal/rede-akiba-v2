import { useMutation, useQueryClient } from '@tanstack/react-query';
import { AvisosParaEquipeTypes } from './types';
import { 
    createAvisoParaEquipe,
    updateAvisoParaEquipe,
    removeAvisoParaEquipe,
} from './api';

export function useCreateAvisoParaEquipe(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: AvisosParaEquipeTypes) => createAvisoParaEquipe(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar um aviso para equipe:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['AvisosParaEquipe'] });
        }
    })
}

export function useUpdateAvisoParaEquipe(id: number, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: AvisosParaEquipeTypes) => updateAvisoParaEquipe(id, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar um aviso para equipe:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['AvisosParaEquipe', {id}] });
        }
    })
}

export function useRemoveAvisoParaEquipe(id: number, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: () => removeAvisoParaEquipe(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover um aviso para equipe:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['AvisosParaEquipe', {id}] });
        }
    })
}