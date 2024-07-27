import { useMutation, useQueryClient } from '@tanstack/react-query';
import { VideosDoYoutubeType } from './types';
import { 
    createVideoDoYoutube,
    updateVideoDoYoutube,
    removeVideoDoYoutube
} from './api';

export function useCreateVideoDoYoutube(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: VideosDoYoutubeType) => createVideoDoYoutube(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar um vídeo do youtube', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Vídeos'] });
        }
    })
}

export function useUpdateVideoDoYoutube(id: number, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: VideosDoYoutubeType) => updateVideoDoYoutube(id, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar um vídeo do youtube', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Vídeos', {id}] });
        }
    })
}

export function useRemoveVideoDoYoutube(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removeVideoDoYoutube(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover um vídeo do youtube', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Vídeos'] });
        }
    })
}