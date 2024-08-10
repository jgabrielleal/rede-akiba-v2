import BoasVindas from "@/components/partials/Dashboard/BoasVindas";
import AvisosParaEquipe from "@/components/partials/Dashboard/AvisosParaEquipe";
import AcoesRapidas from "@/components/partials/Dashboard/AcoesRapidas";

export default function Dashboard() {
    return (
        <>
            <BoasVindas />
            <AvisosParaEquipe/>
            <AcoesRapidas/>
        </>
    )
}