import { MdOutlineKeyboardDoubleArrowRight } from "react-icons/md";
import { useAvisosParaEquipe } from "@/services/avisos_para_equipe/queries";
import AvisosParaEquipePlaceholder from "@/components/skeletons/Dashboard/AvisosParaEquipe/AvisosParaEquipePlaceholder";
import AvisosParaEquipeFallback from "@/components/skeletons/Dashboard/AvisosParaEquipe/AvisosParaEquipeFallback";

export default function AvisosParaEquipe() {
    const { data: avisosParaEquipe, isLoading } = useAvisosParaEquipe();
    
    if (isLoading) {
        return <AvisosParaEquipePlaceholder />
    }

    if (!avisosParaEquipe) {
        return <AvisosParaEquipeFallback />
    }

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Avisos para equipe</h6>
            </div>
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mt-3">
                {avisosParaEquipe.slice(0, 4).map((aviso: any, index: number) => (
                    <div key={index} className="w-full h-40 bg-azul-claro rounded-md p-3">
                        <h6 className="font-averta font-bold text-aurora text-xl uppercase flex items-center gap-1">
                            {aviso.remetente.apelido}<MdOutlineKeyboardDoubleArrowRight className="mt-1" />{aviso.destinatario.apelido}
                        </h6>
                        <p className="font-averta text-aurora text-xs line-clamp-6 mt-1">
                            {aviso.mensagem}
                        </p>
                    </div>
                ))}
            </div>
        </section>
    )
}