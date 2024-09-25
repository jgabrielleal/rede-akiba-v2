import { useEffect } from "react";
import { useQueryClient } from "@tanstack/react-query";
import { useParams } from "react-router-dom";
import { usePageName } from "@/hooks/usePageName";
import { useMateria } from '@/services/materias/queries';
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
    usePageName(materia?.titulo || "Nova matéria");
    
    useEffect(() => {
        queryClient.invalidateQueries({queryKey: ['Materias']});
        queryClient.invalidateQueries({queryKey: ['MateriasInfinite']});
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
                    <CapaDaMateria />
                    <EscrevaSuaMateria />
                </div>
            </div>
                <div className="w-10/12 xl:w-[75rem] mx-auto mt-10 flex justify-end">
                    <Tags />
                </div>
                <div className="w-10/12 xl:w-[75rem] mx-auto mt-10 flex justify-end">
                    <FontesDePesquisa />
                </div>
            <div>
                <SubmitDeMateria />
            </div>
            <TodasAsMaterias/>
        </>
    );
}