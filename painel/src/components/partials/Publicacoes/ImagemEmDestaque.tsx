import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useMateria } from "@/services/materias/queries";
import { useEvento } from "@/services/eventos/queries";
import { useReview } from "@/services/reviews/queries";
import ImagemEmDestaquePlaceholder from "@/components/skeletons/Publicacoes/ImagemEmDestaque/ImagemEmDestaquePlaceholder";

export default function ImagemEmDestaque() {
    const { slug, publicacao } = useParams();

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

    function destaqueDispatch() {
        const tituloMap: { [key: string]: string | undefined } = {
            eventos: evento?.capa_do_evento,
            materias: materia?.capa_da_materia,
            reviews: review?.capa_da_review
        };
        return tituloMap[publicacao ?? "materias"] ?? "";
    }

    useEffect(() => {
        setImagemPreview(destaqueDispatch());
    }, [materia, evento, review, publicacao]);

    if (materiaLoading || eventoLoading || reviewLoading) {
        return <ImagemEmDestaquePlaceholder />;
    }

    return (
        <>
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Imagem em destaque
            </span>
            <label htmlFor="imagemEmDestaque" className={`w-full ${!imagemPreview && "h-72 bg-aurora"} rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold`}>
                {imagemPreview ? (
                    <img src={imagemPreview} alt="Imagem em destaque" className="w-full h-auto bg-aurora rounded-md object-cover" />
                ) : (
                    "+"
                )}
            </label>
            <input type="file" id="imagemEmDestaque" className="hidden" onChange={handleImageChange} />
        </>
    );
}