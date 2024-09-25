import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import classNames from 'classnames';
import { useImagePreview } from "@/hooks/useImagePreview";
import { useReview } from "@/services/reviews/queries";

import CapaDaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/CapaDaPublicacao/CapaDaPublicacaoPlaceholder";

export default function CapaDoReview() {
    const { slug } = useParams();
    const { data: review, isLoading } = useReview(slug ?? "");
    const previewDeImagem = useImagePreview;

    const [imagemPreview, setImagemPreview] = useState<string | null>();

    useEffect(()=>{
        setImagemPreview(review?.capa_da_review || null);
    }, [review])

    if (isLoading) {
        return <CapaDaPublicacaoPlaceholder />;
    }

    return (
        <section className="mb-3">
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Capa do review
            </span>
            <label htmlFor="capaDoReview" className={classNames('w-full rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold',
                { 'h-72 bg-aurora': !imagemPreview }
            )}>
                {imagemPreview ? (
                    <img src={imagemPreview} alt="Capa do review" className="w-full h-72 bg-aurora rounded-md object-cover" />
                ) : (
                    "+"
                )}
            </label>
            <input type="file" id="capaDoReview" className="hidden" onChange={(e) => { previewDeImagem(e, setImagemPreview) }} />
        </section>
    )
}