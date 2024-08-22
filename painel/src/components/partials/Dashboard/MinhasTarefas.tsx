import { useState } from "react";
import { toast } from "react-toastify";
import { useTarefas } from "@/services/tarefas/queries";
import { useUpdateTarefa } from "@/services/tarefas/mutations";
import MinhasTarefasPlaceholder from "@/components/skeletons/Dashboard/MinhasTarefas/MinhasTarefasPlaceholder";
import MinhasTarefasFallback from "@/components/skeletons/Dashboard/MinhasTarefas/MinhasTarefasFallback";

interface TarefasInterface{
    id: number,
    created_at: string,
    updated_at: string,
    administrador: object,
    executante: object,
    tarefa_a_ser_executada: string,
    tarefa_concluida: boolean,
}

export default function MinhasTarefas() {
    const [isTarefaSelecionada, setIsTarefaSelecionada] = useState(0);

    const { data: tarefas, isLoading } = useTarefas();
    const { mutate: updateTarefa } = useUpdateTarefa(isTarefaSelecionada, ()=>{
        toast.success('Sugoi nee!! Tarefinha concluída! (≧▽≦)');
    });

    if(isLoading){
        return <MinhasTarefasPlaceholder />
    }

    if(!tarefas?.data){
        return <MinhasTarefasFallback />
    }

    const tarefasLista = tarefas?.data;

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Minhas Tarefas</h6>
            </div>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-2 mt-3">
                {tarefasLista?.map((tarefa: TarefasInterface, index: number) => {
                    const cardStyle = tarefa.tarefa_concluida ? "bg-verde" : "bg-azul-claro";

                    return (
                        <div key={index} className={`${cardStyle} py-2 px-5 flex justify-between rounded-md font-averta text-aurora`}>
                            {tarefa.tarefa_a_ser_executada}
                            <div>
                                <input 
                                    type="checkbox" 
                                    aria-label="Marcar tarefa como concluída" 
                                    disabled={tarefa.tarefa_concluida} 
                                    onChange={() => {
                                        setIsTarefaSelecionada(tarefa.id);
                                        updateTarefa({ 
                                            tarefa_concluida: true 
                                        });
                                    }}  
                                />
                            </div>
                        </div>
                    );
                })}
            </div>
        </section>
    )
}