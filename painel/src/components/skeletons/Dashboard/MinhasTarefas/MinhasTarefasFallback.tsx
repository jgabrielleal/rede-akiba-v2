export default function MinhasTarefasFallback() {
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Minhas Tarefas</h6>
            </div>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-2 mt-3">
                <div className="bg-azul-fallback py-2 px-5 flex justify-between rounded-md font-averta text-aurora animate-pulse">
                    Oba amigo! Não tem tarefas para você. Aproveita para colocar o anime em dia!
                </div>
            </div>
        </section>
    )
}