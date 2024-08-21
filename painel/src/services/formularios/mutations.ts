import { useMutation, useQueryClient } from '@tanstack/react-query';
import { FormulariosTypes } from './types';
import { 
    createFormulario,
    updateFormulario,
    removeFormulario
} from './api';

export function useCreateFormulario(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: FormulariosTypes) => createFormulario(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar um formulário:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Formularios'] });
        }
    })
}

export function useUpdateFormulario(id: number, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: FormulariosTypes) => updateFormulario(id, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar um formulário:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Formularios'] });
        }
    })
}

export function useRemoveFormulario(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removeFormulario(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao deletar um formulário:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Formularios'] });
        }
    })
}

