import { useState, useEffect } from "react";
import { useQueryClient } from "@tanstack/react-query";
import { useParams } from "react-router-dom";
import { useForm } from "react-hook-form";
import { useError } from "@/hooks/useError";
import { usePageName } from "@/hooks/usePageName";
import { useLogado } from "@/services/login/queries";
import { useMateria } from '@/services/materias/queries';
import { useCreateMateria } from "@/services/materias/mutations";
import { useUpdateMateria } from '@/services/materias/mutations';

import SwitchDePublicacoes from "@/components/partials/Publicacoes/SwitchDePublicacoes";
import ImagemEmDestaque from "@/components/partials/Publicacoes/Materias/ImagemEmDestaque";
import Titulo from "@/components/partials/Publicacoes/Materias/Titulo";
import CapaDaMateria from "@/components/partials/Publicacoes/Materias/CapaDaMateria";
import EscrevaSuaMateria from "@/components/partials/Publicacoes/Materias/EscrevaSuaMateria";
import Tags from "@/components/partials/Publicacoes/Materias/Tags";
import FontesDePesquisa from "@/components/partials/Publicacoes/Materias/FontesDePesquisa";
import SubmitDeMateria from "@/components/partials/Publicacoes/Materias/SubmitDeMateria";
import TodasAsMaterias from "@/components/partials/Publicacoes/Materias/TodasAsMaterias";

export default function Materias() {
    const { slug } = useParams();
    const queryClient = useQueryClient();
    const { data: materia } = useMateria(slug ?? "");
    const { mutate: updateMateria } = useUpdateMateria(slug ?? "", () => { alert("Matéria atualizada com sucesso!"); });
    const { mutate: createMateria } = useCreateMateria(() => { alert("Matéria criada com sucesso!"); });
    const { register, handleSubmit, setValue } = useForm();
    const { data: logado } = useLogado(localStorage.getItem('aki-token') || '');
    const { data: onError } = useError();
    const { data: pageName } = usePageName();

    pageName(materia?.titulo || "Nova matéria");

    useEffect(() => {
        queryClient.invalidateQueries({ queryKey: ['Materias'] });
        queryClient.invalidateQueries({ queryKey: ['MateriasInfinite'] });
    }, [slug]);

    const [isStatusDaMateria, setIsStatusDaMateria] = useState<string | null>();

    function onSubmit(data: any) {

        const newData = {
            status: isStatusDaMateria,
            autor: logado.id,
            imagem_em_destaque: data.imagem_em_destaque,
            capa_da_materia: data.capa_da_materia,
            titulo: data.titulo,
            conteudo: data.escreva_sua_materia,
            tags: [data.primeiraTag, data.segundaTag],
            fontes_de_pesquisa: [
                { site: data.primeiraFonteDePesquisaNome, link: data.primeiraFonteDePesquisaLink },
                { site: data.segundaFonteDePesquisaNome, link: data.segundaFonteDePesquisaLink }
            ],
        };

        if (slug) {
            if (data.imagem_em_destaque.length === 0) {
                delete newData.imagem_em_destaque;
            }
            if (data.capa_da_materia.length === 0) {
                delete newData.capa_da_materia;
            }

            delete newData.autor;
            updateMateria(newData);
        } else {
            createMateria(newData);
        }
    }

    return (
        <>
            <SwitchDePublicacoes />
            <form onSubmit={handleSubmit(onSubmit, onError)}>
                <div className="container mx-auto mt-8 grid grid-cols-1 xl:grid-cols-4 gap-4 w-10/12 xl:w-[75rem]">
                    <div className="col-span-1 xl:col-span-1">
                        <ImagemEmDestaque register={register} setValue={setValue} />
                    </div>
                    <div className="col-span-1 xl:col-span-3">
                        <Titulo register={register} />
                        <CapaDaMateria register={register} setValue={setValue} />
                        <EscrevaSuaMateria register={register} setValue={setValue} />
                    </div>
                </div>
                <div className="w-10/12 xl:w-[75rem] mx-auto mt-10 flex justify-end">
                    <Tags register={register} />
                </div>
                <div className="w-10/12 xl:w-[75rem] mx-auto mt-10 flex justify-end">
                    <FontesDePesquisa register={register} />
                </div>
                <div>
                    <SubmitDeMateria setStatusDaMateria={setIsStatusDaMateria} />
                </div>
            </form>
            <TodasAsMaterias />
        </>
    );
}