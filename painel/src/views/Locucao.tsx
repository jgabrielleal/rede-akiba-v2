import Programas from "@/components/partials/Locucao/Programas"
import FraseDoPrograma from "@/components/partials/Locucao/FraseDoPrograma"
import IconesDeFrases from "@/components/partials/Locucao/IconesDeFrases"
import SubmitDePrograma from "@/components/partials/Locucao/SubmitDePrograma"
import PedidosMusicais from "@/components/partials/Locucao/PedidosMusicais"

export default function Locucao(){
    return(
        <>
            <Programas />
            <FraseDoPrograma /> 
            <IconesDeFrases />
            <SubmitDePrograma />
            <PedidosMusicais />
        </>
    )
}