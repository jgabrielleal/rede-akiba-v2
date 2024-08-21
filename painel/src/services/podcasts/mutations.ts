import { useMutation, useQueryClient } from '@tanstack/react-query';
import { PodcastsTypes } from './types';
import {
    createPodcast,
    removePodcast,
    updatePodcast
} from './api';

export function useCreatePodcast(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: PodcastsTypes) => createPodcast(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar um podcast:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Podcasts'] });
        }
    })
}

export function useUpdatePodcast(slug: string, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: PodcastsTypes) => updatePodcast(slug, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar um podcast:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Podcasts'] });
        }
    })
}

export function useRemovePodcast(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removePodcast(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover um podcast:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Podcasts'] });
        }
    })
}