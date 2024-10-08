import { useMutation, useQueryClient } from '@tanstack/react-query';
import { MateriasTypes } from './types';
import { 
    createMateria,
    updateMateria,
    removeMateria
} from './api';

export function useCreateMateria(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: MateriasTypes) => createMateria(data),
        onSuccess: async () => {
            onSuccessCallback();
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar uma matéria:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Materias'] });
            await queryClient.invalidateQueries({ queryKey: ['MateriasInfinite'] });
        }
    })
}

export function useUpdateMateria(slug: string, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: MateriasTypes) => updateMateria(slug, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar uma matéria:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Materias'] });
            await queryClient.invalidateQueries({ queryKey: ['MateriasInfinite'] });
        }
    })
}

export function useRemoveMateria(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removeMateria(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover uma matéria:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Materias'] });
            await queryClient.invalidateQueries({ queryKey: ['MateriasInfinite'] });
        }
    })
}