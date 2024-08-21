import { useMutation, useQueryClient } from '@tanstack/react-query';
import { ReviewsTypes } from './types';
import { 
    createReview,
    updateReview,
    removeReview
} from './api';

export function useCreateReview(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: ReviewsTypes) => createReview(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar uma review:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Reviews'] });
        }
    })
}

export function useUpdateReview(slug: string, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: ReviewsTypes) => updateReview(slug, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar uma review:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Review'] });
        }
    })
}

export function useRemoveReview(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removeReview(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover uma review:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Reviews'] });
        }
    })
}