import BotoesDeTiposDePublicacao from "@/components/partials/Publicacoes/BotoesDeTiposDePublicacao";
import ImagemEmDestaque from "@/components/partials/Publicacoes/ImagemEmDestaque";
import Titulo from "@/components/partials/Publicacoes/Titulo";
import CapaDaPublicacao from "@/components/partials/Publicacoes/CapaDaPublicacao";
import EscrevaSuaPublicacao from "@/components/partials/Publicacoes/EscrevaSuaPublicacao";
import Tags from "@/components/partials/Publicacoes/Tags";
import FontesDePesquisa from "@/components/partials/Publicacoes/FontesDePesquisa";
import LocalDatas from "@/components/partials/Publicacoes/LocalDatas";
import Controles from "@/components/partials/Publicacoes/Controles";

import BotoesDeTiposDePublicacaoPlaceholder from "@/components/skeletons/Publicacoes/BotoesDeTiposDePublicacaoPlaceholder";
import ImagemEmDestaquePlaceholder from "@/components/skeletons/Publicacoes/ImagemEmDestaquePlaceholder";
import TituloPlaceholder from "@/components/skeletons/Publicacoes/TituloPlaceholder";
import CapaDaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/CapaDaPublicacaoPlaceholder";
import EscrevaSuaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/EscrevaSuaPublicacaoPlaceholder";
import TagsPlaceholder from "@/components/skeletons/Publicacoes/TagsPlaceholder";
import FontesDePesquisaPlaceholder from "@/components/skeletons/Publicacoes/FontesDePesquisaPlaceholder";
import LocalDatasPlaceholder from "@/components/skeletons/Publicacoes/LocalDatasPlaceholder";

export default function Publicacoes() {
    return (
        <>
            <BotoesDeTiposDePublicacao />
            <div className="container mx-auto mt-8 grid grid-cols-1 xl:grid-cols-4 gap-4 w-10/12 xl:w-[75rem]">
                <div className="col-span-1 xl:col-span-1">
                    <ImagemEmDestaque />
                </div>
                <div className="col-span-1 xl:col-span-3">
                    <Titulo />
                    <CapaDaPublicacao />
                    <EscrevaSuaPublicacao />
                </div>
            </div>
            <div className="w-10/12 xl:w-[75rem] mx-auto mt-10 flex justify-end">
                <Tags />
            </div>
            <div className="w-10/12 xl:w-[75rem] mx-auto mt-10 flex justify-end">
                <FontesDePesquisa />
            </div>
            <div className="w-10/12 xl:w-[75rem] mx-auto mt-10 flex justify-end">
                <LocalDatas />
            </div>
            <div>
                <Controles />
            </div>
        </>
    );
}