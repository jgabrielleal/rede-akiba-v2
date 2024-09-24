import { useParams } from 'react-router-dom';

export default function Controles() {
    const { publicacao } = useParams();
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto pt-8">
            <div className="flex gap-3 flex-wrap justify-center items-center my-3">
                {publicacao !== "reviews" && publicacao !== "eventos" && (
                    <>
                        <button className="px-4 py-1 border-4 border-verde rounded-xl font-averta font-bold text-verde text-xl text-azul-claro uppercase">
                            Salvar rascunho
                        </button>
                        <button className="px-4 py-1 border-4 border-laranja-claro rounded-xl font-averta font-bold text-laranja-claro text-xl uppercase">
                            Mandar para revisão
                        </button>
                    </>
                )}
                <button className="px-4 py-1 border-4 border-azul-claro rounded-xl font-averta font-bold text-azul-claro text-xl uppercase">
                    Publicar {publicacao === "reviews" ? "review" : "evento"}
                </button>
            </div>
        </section>
    )
}