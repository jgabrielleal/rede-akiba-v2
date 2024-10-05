import { useState, useEffect } from "react";
import { useQueryClient } from "@tanstack/react-query";
import { useParams } from "react-router-dom";
import { toast } from "react-toastify";
import { useForm } from "react-hook-form";
import { usePageName } from "@/hooks/usePageName";
import { useError } from "@/hooks/useError";
import { useLogado } from "@/services/login/queries";
import { useEvento } from '@/services/eventos/queries';
import { useCreateEvento } from '@/services/eventos/mutations';
import { useUpdateEvento } from '@/services/eventos/mutations';

import SwitchDePublicacoes from "@/components/partials/Publicacoes/SwitchDePublicacoes";
import ImagemEmDestaque from "@/components/partials/Publicacoes/Eventos/ImagemEmDestaque";
import Titulo from "@/components/partials/Publicacoes/Eventos/Titulo";
import CapaDoEvento from "@/components/partials/Publicacoes/Eventos/CapaDoEvento";
import EscrevaSobreOEvento from "@/components/partials/Publicacoes/Eventos/EscrevaSobreOEvento";
import SubmitDoEvento from "@/components/partials/Publicacoes/Eventos/SubmitDoEvento";
import TodosOsEventos from "@/components/partials/Publicacoes/Eventos/TodosOsEventos";
import LocalizacaoDoEvento from "@/components/partials/Publicacoes/Eventos/LocalizacaoDoEvento";

export default function Reviews() {
    const [isRefresh, setIsRefresh] = useState<boolean>(false);

    const { register, handleSubmit, setValue, reset } = useForm();

    const { slug } = useParams();

    const queryClient = useQueryClient();
    const { data: logado } = useLogado(localStorage.getItem("aki-token") ?? "");
    const { data: evento } = useEvento(slug ?? "");
    const { mutate: createEvento } = useCreateEvento(() => {
        toast.success('"Sugoi! O seu evento foi criado! ٩(＾◡＾)۶"');
        setIsRefresh(prev => !prev);
        reset();
    })
    const { mutate: updateEvento } = useUpdateEvento(slug ?? "", () => {
        toast.success("Sugoi! O evento foi atualizado! ٩(＾◡＾)۶");
        setIsRefresh(prev => !prev);
        reset();
    })

    const { data: onError } = useError();
    const { data: pageName } = usePageName();

    pageName(evento?.titulo || "Novo evento");

    useEffect(() => {
        queryClient.invalidateQueries({ queryKey: ['Eventos'] });
        queryClient.invalidateQueries({ queryKey: ['EventosInfinite'] });
    }, [slug]);

    function onSubmit(data: any) {
        const newData = {
            autor: logado?.id,
            titulo: data.titulo,
            imagem_em_destaque: data.imagem_em_destaque,
            capa_do_evento: data.capa_do_evento,
            datas: data.datas,
            local: data.local,
            conteudo: data.conteudo
        }

        if (slug) {
            updateEvento(newData)
        } else {
            createEvento(newData)
        }
    }

    return (
        <>
            <SwitchDePublicacoes />
            <form onSubmit={handleSubmit(onSubmit, onError)} key={isRefresh ? 'refresh-true' : 'refresh-false'}>
                <div className="container mx-auto mt-8 grid grid-cols-1 xl:grid-cols-4 gap-4 w-10/12 xl:w-[75rem]">
                    <div className="col-span-1 xl:col-span-1">
                        <ImagemEmDestaque register={register} setValue={setValue} />
                    </div>
                    <div className="col-span-1 xl:col-span-3">
                        <Titulo register={register} setValue={setValue} />
                        <CapaDoEvento register={register} setValue={setValue} />
                        <EscrevaSobreOEvento register={register} setValue={setValue} />
                    </div>
                    <div className="w-10/12 xl:w-[75rem] mx-auto mt-10 flex justify-end">
                        <LocalizacaoDoEvento register={register} setValue={setValue} />
                    </div>
                </div>
                <SubmitDoEvento />
            </form>
            <TodosOsEventos />
        </>
    );
}