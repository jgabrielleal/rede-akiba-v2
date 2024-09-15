import { useParams } from "react-router-dom";

import BotoesDeTiposDePublicacao from "@/components/partials/Publicacoes/BotoesDeTiposDePublicacao";
import ImagemEmDestaque from "@/components/partials/Publicacoes/ImagemEmDestaque";
import Titulo from "@/components/partials/Publicacoes/Titulo";
import SinopseDoAnime from "@/components/partials/Publicacoes/SinopseDoAnime";
import CapaDaPublicacao from "@/components/partials/Publicacoes/CapaDaPublicacao";
import EscrevaSeuReview from "@/components/partials/Publicacoes/EscrevaSeuReview";
import EscrevaSuaPublicacao from "@/components/partials/Publicacoes/EscrevaSuaPublicacao";
import Tags from "@/components/partials/Publicacoes/Tags";
import FontesDePesquisa from "@/components/partials/Publicacoes/FontesDePesquisa";
import LocalDatas from "@/components/partials/Publicacoes/LocalDatas";
import Controles from "@/components/partials/Publicacoes/Controles";
import TodasAsPublicacoes from "@/components/partials/Publicacoes/TodasAsPublicacoes";

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
                        <SinopseDoAnime />
                    )}
                    <CapaDaPublicacao />
                    {publicacao !== "reviews" && (
                        <EscrevaSuaPublicacao />
                    )}
                    {publicacao === "reviews" && (
                        <EscrevaSeuReview />
                    )}
                </div>
            </div>
            {publicacao !== "eventos" && publicacao !== "reviews" && (
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
            {publicacao === "materias" && (
                <TodasAsPublicacoes />
            )}
        </>
    );
}