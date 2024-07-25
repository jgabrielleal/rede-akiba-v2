import { useMutation, useQueryClient } from '@tanstack/react-query';
import { toast } from 'react-toastify';
import { 
    Login,
    Deslogar
} from './api';

export function useLogin(){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data:any) => Login(data),
        onSuccess: async (response: any) => {
            await queryClient.invalidateQueries({ queryKey: ['Login'] });
            localStorage.setItem('aki-token', response.data.token);
            toast.success('Login realizado com sucesso!');
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao fazer login:', error)
        },
    })
}

export function useDeslogar(){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (token: string) => Deslogar(token),
        onSuccess: () => {
            toast.dismiss();
            toast.success('Deslogado com sucesso!');
        },
        onMutate: () => {
            toast.loading("Deslogando...");
        },
        onError: (response: any) => {
            toast.error(response.data);
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Login'] });
        }
    })
}