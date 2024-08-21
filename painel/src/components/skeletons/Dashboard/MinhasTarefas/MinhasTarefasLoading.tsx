export default function MinhasTarefasLoading() {
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Minhas Tarefas</h6>
            </div>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-2 mt-3">
                {[...Array(4)].map((_, index) => (
                    <div key={index} className="bg-azul-placeholder py-2 px-5 flex justify-between rounded-md font-averta text-aurora animate-pulse">
                    </div>
                ))}
            </div>
        </section>
    )
}