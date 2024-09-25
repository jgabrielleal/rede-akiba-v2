import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useImagePreview } from "@/hooks/useImagePreview";
import { useMateria } from "@/services/materias/queries";
import CapaDaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/CapaDaPublicacao/CapaDaPublicacaoPlaceholder";

export default function CapaDaMateria() {
    const { slug } = useParams();
    const { data: materia, isLoading } = useMateria(slug ?? "");
    const previewDeImagem = useImagePreview;

    const [imagemPreview, setImagemPreview] = useState<string | null>();

    useEffect(()=>{
        setImagemPreview(materia?.capa_da_materia || null);
    }, [materia])

    if (isLoading) {
        return <CapaDaPublicacaoPlaceholder />;
    }

    return (
        <section className="mb-3">
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Capa da matéria
            </span>
            <label htmlFor="capaDaMateria" className={`w-full h-72 ${!imagemPreview && "bg-aurora"} rounded-md overflow-hidden flex justify-center items-center text-azul-claro text-6xl font-averta font-bold`}>
                {imagemPreview ? (
                    <img src={imagemPreview} alt="Capa da matéria" className="w-full h-72 bg-aurora rounded-md object-cover" />
                ) : (
                    "+"
                )}
            </label>
            <input type="file" id="capaDaMateria" className="hidden" onChange={(e)=>{previewDeImagem(e, setImagemPreview)}} />
        </section>
    )
}