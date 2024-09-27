import { usePageName } from "@/hooks/usePageName";
import BoasVindas from "@/components/partials/Dashboard/BoasVindas";
import AvisosParaEquipe from "@/components/partials/Dashboard/AvisosParaEquipe";
import AcoesRapidas from "@/components/partials/Dashboard/AcoesRapidas";
import StatusDaRadio from "@/components/partials/Dashboard/StatusDaRadio";
import MinhasTarefas from "@/components/partials/Dashboard/MinhasTarefas";
import UltimasMaterias from "@/components/partials/Dashboard/UltimasMaterias";
import Calendario from "@/components/partials/Dashboard/Calendario";

export default function Dashboard() {
    const { data: pageName } = usePageName()
    pageName('Dashboard');
    
    return (
        <>
            <BoasVindas />
            <AvisosParaEquipe/>
            <AcoesRapidas/>
            <StatusDaRadio/>
            <MinhasTarefas/>
            <UltimasMaterias/>
            <Calendario/>
        </>
    )
}