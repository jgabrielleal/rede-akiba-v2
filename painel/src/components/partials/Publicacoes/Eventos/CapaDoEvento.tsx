import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import classNames from 'classnames';
import { useImagePreview } from "@/hooks/useImagePreview";
import { useEvento } from "@/services/eventos/queries";

import CapaDaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/CapaDaPublicacao/CapaDaPublicacaoPlaceholder";

export default function CapaDoEvento() {
    const { slug } = useParams();
    const { data: evento, isLoading } = useEvento(slug ?? "");
    const { data: previewDeImagem } = useImagePreview();

    const [imagemPreview, setImagemPreview] = useState<string | null>();

    useEffect(()=>{
        setImagemPreview(evento?.capa_do_evento || null);
    }, [evento])

    if (isLoading) {
        return <CapaDaPublicacaoPlaceholder />;
    }

    return (
        <section className="mb-3">
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Capa do evento
            </span>
            <label htmlFor="capaDoEvento" className={classNames('w-full rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold',
                { 'h-72 bg-aurora': !imagemPreview }
            )}>                {imagemPreview ? (
                    <img src={imagemPreview} alt="Capa do evento" className="w-full h-72 bg-aurora rounded-md object-cover" />
                ) : (
                    "+"
                )}
            </label>
            <input type="file" id="capaDoEvento" className="hidden" onChange={(e)=>{ previewDeImagem(e, setImagemPreview) }} />
        </section>
    )
}