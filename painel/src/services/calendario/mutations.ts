import { useMutation, useQueryClient } from '@tanstack/react-query';
import { CalendarioTypes } from './types';
import { 
    createEventoCalendario,
    updateEventoCalendario,
    removeEventoCalendario,
} from './api';

export function useCreateEventoCalendario(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: CalendarioTypes) => createEventoCalendario(data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao criar um evento no calendário:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Calendario'] });
        }
    })
}

export function useUpdateEventoCalendario(id: number, onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (data: CalendarioTypes) => updateEventoCalendario(id, data),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao atualizar um evento no calendário:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Calendario'] });
        }
    })
}

export function useRemoveEventoCalendario(onSuccessCallback: Function){
    const queryClient = useQueryClient();
    return useMutation({
        mutationFn: (id: number) => removeEventoCalendario(id),
        onSuccess: () => {
            onSuccessCallback()
        },
        onError: (error: any) => {
            console.log('Ocorreu um erro ao remover um evento no calendário:', error)
        },
        onSettled: async () => {
            await queryClient.invalidateQueries({ queryKey: ['Calendario'] });
        }
    })
}