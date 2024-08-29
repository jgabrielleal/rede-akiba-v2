export default function BotoesDeTiposDePublicacao() {
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto pt-8">
            <div className="title-default">
                <h6>Criar Matérias</h6>
            </div>
            <div className="flex gap-3 flex-wrap justify-center items-center my-3">
                <button className="px-4 py-1 border-4 border-azul-claro rounded-xl font-averta font-bold text-aurora text-xl text-azul-claro uppercase">
                    Matérias
                </button>
                <button className="px-4 py-1 border-4 border-roxo rounded-xl font-averta font-bold text-aurora text-xl text-roxo uppercase">
                    Review
                </button>
                <button className="px-4 py-1 border-4 border-laranja-medio rounded-xl font-averta font-bold text-aurora text-xl text-laranja-medio uppercase">
                    Evento
                </button>
            </div>
        </section>
    )
}