import { useMutation, useQueryClient } from '@tanstack/react-query';
import { useNavigate } from 'react-router-dom';
import { toast } from 'react-toastify';
import { 
    Login,
    Deslogar
} from './api';

export function useLogin(){
    const navigate = useNavigate();
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data:any) => Login(data),
        onSuccess: async (response: any) => {
            await queryClient.invalidateQueries({ queryKey: ['Login'] });
            localStorage.setItem('aki-token', response?.data?.token);
            navigate('dashboard')
        },
        onError: (error: any) => {
            toast.error('Credenciais invalidas')
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
        onError: (response: any) => {
            console.log('Ocorreu um erro ao deslogar:', response)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Login'] });
        }
    })
}