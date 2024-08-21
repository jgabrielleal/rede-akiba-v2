import { useMutation, useQueryClient } from '@tanstack/react-query';
import { ProgramasTypes } from './types';
import { 
    createPrograma,
    updatePrograma,
    removePrograma
} from './api';

export function useCreatePrograma(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: ProgramasTypes) => createPrograma(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar um programa:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Programas'] });
        }
    })
}

export function useUpdatePrograma(slug: string, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: ProgramasTypes) => updatePrograma(slug, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar um programa:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Programas'] });
        }
    })
}

export function useRemovePrograma(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (slug: string) => removePrograma(slug),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover um programa:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Programas'] });
        }
    })
}