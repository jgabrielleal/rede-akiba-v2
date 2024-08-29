import BotoesDeTiposDePublicacao from "@/components/partials/Materias/BotoesDeTiposDePublicacao";
import ImagemEmDestaque from "@/components/partials/Materias/ImagemEmDestaque";
import Titulo from "@/components/partials/Materias/Titulo";
import CapaDaMateria from "@/components/partials/Materias/CapaDaMatéria";

import BotoesDeTiposDePublicacaoPlaceholder from "@/components/skeletons/Materias/BotoesDeTiposDePublicacaoPlaceholder";
import ImagemEmDestaquePlaceholder from "@/components/skeletons/Materias/ImagemEmDestaquePlaceholder";
import TituloPlaceholder from "@/components/skeletons/Materias/TituloPlaceholder";
import CapaDaMateriaPlaceholder from "@/components/skeletons/Materias/CapaDaMateriaPlaceholder";

export default function Materias() {
    return (
        <>
            <BotoesDeTiposDePublicacao />
            <div className="w-10/12 xl:w-[75rem] mx-auto mt-8 flex gap-4">
                <div className="w-72">
                    <ImagemEmDestaque />
                </div>
                <div className="w-full">
                    <Titulo />
                    <CapaDaMateria />
                </div>
            </div>
        </>
    )
}