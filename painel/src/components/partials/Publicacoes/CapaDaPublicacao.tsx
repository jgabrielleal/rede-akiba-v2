import React, { useState } from 'react';
import { useParams } from 'react-router-dom';
import CapaDaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/CapaDaPublicacao/CapaDaPublicacaoPlaceholder";

export default function CapaDaPublicacao() {
    const { publicacao } = useParams();

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