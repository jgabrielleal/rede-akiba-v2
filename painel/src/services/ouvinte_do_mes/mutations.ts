import { useMutation, useQueryClient } from '@tanstack/react-query';
import { OuvinteDoMesTypes } from './types';
import { 
    updateOuvinteDoMes
} from './api';

export function useUpdateOuvinteDoMes(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: OuvinteDoMesTypes) => updateOuvinteDoMes(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar o ouvinte do mês:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['OuvinteDoMes'] });
        }
    })
}