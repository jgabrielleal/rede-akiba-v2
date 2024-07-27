import { useMutation, useQueryClient } from '@tanstack/react-query';
import { BatalhaDePlaylistTypes } from './types';
import { 
    updateBatalhaDePlaylist,
} from './api';

export function useUpdateBatalhaDePlaylist(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: BatalhaDePlaylistTypes) => updateBatalhaDePlaylist(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar a batalha de playlist:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['BatalhaDePlaylist'] });
        }
    })
}