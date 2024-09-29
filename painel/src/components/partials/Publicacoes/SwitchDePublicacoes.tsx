export default function SwitchDePublicacoes() {

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto pt-8">
            <div className="title-default">
                <h6>Criar matéria</h6>
            </div>
            <div className="flex gap-3 flex-wrap justify-center items-center my-3">
                <a href="/materias" className="px-4 py-1 border-4 border-azul-claro rounded-xl font-averta font-bold text-aurora text-xl text-azul-claro uppercase">
                    Matérias
                </a>
                <a href="/reviews" className="px-4 py-1 border-4 border-roxo rounded-xl font-averta font-bold text-xl text-roxo uppercase">
                    Reviews
                </a>
                <a href="/eventos" className="px-4 py-1 border-4 border-laranja-medio rounded-xl font-averta font-bold text-xl text-laranja-medio uppercase">
                    Eventos
                </a>
            </div>
        </section>
    );
}
