import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useQueryClient } from "@tanstack/react-query";
import { useMateria } from "@/services/materias/queries";
import { useEvento } from "@/services/eventos/queries";
import { useReview } from "@/services/reviews/queries";
import CapaDaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/CapaDaPublicacao/CapaDaPublicacaoPlaceholder";

export default function CapaDaPublicacao() {
    const { slug, publicacao } = useParams();

    const queryClient = useQueryClient();
    const { data: materia, isLoading: materiaLoading } = useMateria(slug ?? "");
    const { data: evento, isLoading: eventoLoading } = useEvento(slug ?? "");
    const { data: review, isLoading: reviewLoading } = useReview(slug ?? "");

    const [imagemPreview, setImagemPreview] = useState<string | null>(null);

    const handleImageChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const file = event.target.files?.[0];
        if (file) {
            const reader = new FileReader();
            reader.onloadend = () => {
                setImagemPreview(reader.result as string);
            };
            reader.readAsDataURL(file);
        }
    };

    function capaDispatch() {
        const tituloMap: { [key: string]: string | undefined } = {
            eventos: evento?.capa_do_evento,
            materias: materia?.capa_da_materia,
            reviews: review?.capa_da_review
        };
        return tituloMap[publicacao ?? "materias"] ?? "";
    }

    useEffect(() => {
        setImagemPreview(capaDispatch());
    }, [materia, evento, publicacao]);

    useEffect(() => {
        queryClient.invalidateQueries({queryKey: ["Materias"]});
        queryClient.invalidateQueries({queryKey: ["MateriasInfinite"]});
        queryClient.invalidateQueries({queryKey: ["Eventos"]});
        queryClient.invalidateQueries({queryKey: ["Reviews"]});
    }, [slug]);

    if (materiaLoading || eventoLoading || reviewLoading) {
        return <CapaDaPublicacaoPlaceholder />;
    }

    return (
        <section className="mb-3">
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Capa {publicacao === "reviews" ? "do review" : publicacao === "eventos" ? "do evento" : "da matéria"}
            </span>
            <label htmlFor="capaDaPublicacao" className={`w-full h-72 ${!imagemPreview && "bg-aurora"} rounded-md overflow-hidden flex justify-center items-center text-azul-claro text-6xl font-averta font-bold`}>
                {imagemPreview ? (
                    <img src={imagemPreview} alt="Capa da publicacao" className="w-full h-auto bg-aurora rounded-md object-cover" />
                ) : (
                    "+"
                )}
            </label>
            <input type="file" id="capaDaPublicacao" className="hidden" onChange={handleImageChange} />
        </section>
    )
}