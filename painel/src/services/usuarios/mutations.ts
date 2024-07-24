import { useMutation, useQueryClient } from '@tanstack/react-query';
import { UsuarioType } from './types';
import { 
    createUsuario,
    updateUsuario,
    removeUsuario
} from './api';

export function useCreateUsuario(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: UsuarioType) => createUsuario(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onMutate: () => {
            console.log('Criando o usuário...')
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar o usuário:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Usuarios'] });
        }
    })
}

export function useUpdateUsuario(slug: string, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: UsuarioType) => updateUsuario(slug, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onMutate: () => {
            console.log('Atualizando o usuário...')
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar o usuário:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Usuarios', {slug}] });
        }
    })
}

export function useRemoveUsuario(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removeUsuario(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onMutate: () => {
            console.log('Removendo o usuário...')
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover o usuário:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Usuarios'] });
        }
    })
}
