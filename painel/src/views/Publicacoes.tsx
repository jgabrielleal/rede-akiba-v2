import { useParams } from "react-router-dom";

import BotoesDeTiposDePublicacao from "@/components/partials/Publicacoes/BotoesDeTiposDePublicacao";
import ImagemEmDestaque from "@/components/partials/Publicacoes/ImagemEmDestaque";
import Titulo from "@/components/partials/Publicacoes/Titulo";
import Sinopse from "@/components/partials/Publicacoes/Sinopse";
import CapaDaPublicacao from "@/components/partials/Publicacoes/CapaDaPublicacao";
import EscrevaSuaPublicacao from "@/components/partials/Publicacoes/EscrevaSuaPublicacao";
import Tags from "@/components/partials/Publicacoes/Tags";
import FontesDePesquisa from "@/components/partials/Publicacoes/FontesDePesquisa";
import LocalDatas from "@/components/partials/Publicacoes/LocalDatas";
import Controles from "@/components/partials/Publicacoes/Controles";
import TodasAsPublicacoes from "@/components/partials/Publicacoes/TodasAsPublicacoes";

import BotoesDeTiposDePublicacaoPlaceholder from "@/components/skeletons/Publicacoes/BotoesDeTiposDePublicacao/BotoesDeTiposDePublicacaoPlaceholder";
import ImagemEmDestaquePlaceholder from "@/components/skeletons/Publicacoes/ImagemEmDestaque/ImagemEmDestaquePlaceholder";
import TituloPlaceholder from "@/components/skeletons/Publicacoes/Titulo/TituloPlaceholder";
import SinopsePlaceholder from "@/components/skeletons/Publicacoes/Sinopse/SinopsePlaceholder";
import CapaDaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/CapaDaPublicacao/CapaDaPublicacaoPlaceholder";
import EscrevaSuaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/EscrevaSuaPublicacao/EscrevaSuaPublicacaoPlaceholder";
import TagsPlaceholder from "@/components/skeletons/Publicacoes/Tags/TagsPlaceholder";
import FontesDePesquisaPlaceholder from "@/components/skeletons/Publicacoes/FontesDePesquisa/FontesDePesquisaPlaceholder";
import LocalDatasPlaceholder from "@/components/skeletons/Publicacoes/LocalDatas/LocalDatasPlaceholder";

export default function Publicacoes() {
    const { publicacao } = useParams();

    return (
        <>
            <BotoesDeTiposDePublicacao />
            <div className="container mx-auto mt-8 grid grid-cols-1 xl:grid-cols-4 gap-4 w-10/12 xl:w-[75rem]">
                <div className="col-span-1 xl:col-span-1">
                    <ImagemEmDestaque />
                </div>
                <div className="col-span-1 xl:col-span-3">
                    <Titulo />
                    {publicacao === "reviews" && (
                        <Sinopse />
                    )}
                    <CapaDaPublicacao />
                    {publicacao !== "reviews" && (
                        <EscrevaSuaPublicacao />
                    )}
                </div>
            </div>
            {publicacao !== "eventos" && (
                <div className="w-10/12 xl:w-[75rem] mx-auto mt-10 flex justify-end">
                    <Tags />
                </div>
            )}
            {publicacao !== "eventos" && (
                <div className="w-10/12 xl:w-[75rem] mx-auto mt-10 flex justify-end">
                    <FontesDePesquisa />
                </div>
            )}
            {publicacao === "eventos" && (
                <div className="w-10/12 xl:w-[75rem] mx-auto mt-10 flex justify-end">
                    <LocalDatas />
                </div>
            )}
            <div>
                <Controles />
            </div>
            <TodasAsPublicacoes />
        </>
    );
}