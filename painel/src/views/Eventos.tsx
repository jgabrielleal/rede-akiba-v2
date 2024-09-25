import { useEffect } from "react";
import { useQueryClient } from "@tanstack/react-query";
import { useParams } from "react-router-dom";
import { usePageName } from "@/hooks/usePageName";
import { useEvento } from '@/services/eventos/queries';
import SwitchDePublicacoes from "@/components/partials/Publicacoes/SwitchDePublicacoes";
import ImagemEmDestaque from "@/components/partials/Publicacoes/Eventos/ImagemEmDestaque";
import Titulo from "@/components/partials/Publicacoes/Eventos/Titulo";
import CapaDoEvento from "@/components/partials/Publicacoes/Eventos/CapaDoEvento";
import EscrevaSobreOEvento from "@/components/partials/Publicacoes/Eventos/EscrevaSobreOEvento";
import SubmitDoEvento from "@/components/partials/Publicacoes/Eventos/SubmitDoEvento";
import TodosOsEventos from "@/components/partials/Publicacoes/Eventos/TodosOsEventos";

export default function Reviews() {
    const { slug } = useParams();
    const queryClient = useQueryClient();
    const { data: evento } = useEvento(slug ?? "");
    usePageName(evento?.titulo || "Novo evento");

    useEffect(() => {
        queryClient.invalidateQueries({queryKey: ['Eventos']});
        queryClient.invalidateQueries({queryKey: ['EventosInfinite']});
    }, [slug]);	

    return (
        <>
            <SwitchDePublicacoes />
            <div className="container mx-auto mt-8 grid grid-cols-1 xl:grid-cols-4 gap-4 w-10/12 xl:w-[75rem]">
                <div className="col-span-1 xl:col-span-1">
                    <ImagemEmDestaque />
                </div>
                <div className="col-span-1 xl:col-span-3">
                    <Titulo />
                    <CapaDoEvento />
                    <EscrevaSobreOEvento />
                </div>
                <SubmitDoEvento />
            </div>
            <TodosOsEventos/>
        </>
    );
}