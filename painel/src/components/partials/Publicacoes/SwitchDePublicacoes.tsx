import { useParams } from 'react-router-dom';

export default function SwitchDePublicacoes() {
    const { slug } = useParams();

    function titleDefault() {
        const url = window.location.href;

        if (slug) {
            if (url.includes("materias")) {
                return "Editar matéria";
            } else if (url.includes("reviews")) {
                return "Editar review";
            } else if (url.includes("eventos")) {
                return "Editar evento";
            }
        }

        if (url.includes("materias")) {
            return "Criar matéria";
        } else if (url.includes("reviews")) {
            return "Criar review";
        } else if (url.includes("eventos")) {
            return "Criar evento";
        }

        return "Criar matéria"; // Default case
    }


    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto pt-8">
            <div className="title-default">
                <h6>{titleDefault()}</h6>
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
