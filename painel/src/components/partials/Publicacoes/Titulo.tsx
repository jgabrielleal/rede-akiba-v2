import { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import { useQueryClient } from "@tanstack/react-query";
import { useMateria } from "@/services/materias/queries";
import { useEvento } from "@/services/eventos/queries";
import { useReview } from "@/services/reviews/queries";
import TituloPlaceholder from "@/components/skeletons/Publicacoes/Titulo/TituloPlaceholder";

export default function Titulo() {
    const { slug, publicacao } = useParams();

    const queryClient = useQueryClient();
    const { data: materia, isLoading: materiaLoading } = useMateria(slug ?? "");
    const { data: evento, isLoading: eventoLoading } = useEvento(slug ?? "");
    const { data: review, isLoading: reviewLoading } = useReview(slug ?? "");

    function tituloDispatch() {
        const tituloMap: { [key: string]: string | undefined } = {
            eventos: evento?.titulo,
            materias: materia?.titulo,
            reviews: review?.titulo
        };
        return tituloMap[publicacao ?? "materias"] ?? "";
    }

    const [isTitulo, setIsTitulo] = useState(tituloDispatch());

    useEffect(() => {
        queryClient.invalidateQueries({queryKey: ["Materias"]});
        queryClient.invalidateQueries({queryKey: ["MateriasInfinite"]});
        queryClient.invalidateQueries({queryKey: ["Eventos"]});
        queryClient.invalidateQueries({queryKey: ["Reviews"]});
    }, [slug]);

    useEffect(() => {
        setIsTitulo(tituloDispatch());
    }, [materia, evento, publicacao]);

    if (materiaLoading || eventoLoading || reviewLoading) {
        return <TituloPlaceholder />;
    }

    return (
        <section className="w-full mb-3">
            <label htmlFor="titulo" className="font-averta font-bold text-laranja-claro text-lg uppercase block mb-1">
                Titulo
            </label>
            <input 
                type="text" 
                name="titulo" 
                id="titulo" 
                className="w-full bg-aurora outline-none rounded-md font-averta p-2" 
                value={isTitulo}
                onChange={(event)=>{setIsTitulo(event.target.value)}}
            />
        </section>
    );
}