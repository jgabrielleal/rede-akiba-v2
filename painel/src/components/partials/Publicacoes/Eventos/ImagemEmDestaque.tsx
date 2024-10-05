import { useEffect } from 'react';
import { useParams } from 'react-router-dom';
import classNames from 'classnames';
import { useImagePreview } from "@/hooks/useImagePreview";
import { useEvento } from "@/services/eventos/queries";

import ImagemEmDestaquePlaceholder from "@/components/skeletons/Publicacoes/ImagemEmDestaque/ImagemEmDestaquePlaceholder";

export default function ImagemEmDestaque({register, setValue} : any) {
    const { slug } = useParams();
    const { data: evento, isLoading } = useEvento(slug ?? "");
    const { converter, preview, setPreview } = useImagePreview();

    useEffect(() => {
        if (slug && evento) {
            setValue('imagem_em_destaque', evento.imagem_em_destaque ?? null);
            setPreview(evento.imagem_em_destaque ?? null);
        }
    }, [slug, evento]);

    if (isLoading) {
        return <ImagemEmDestaquePlaceholder />;
    }

    return (
        <>
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Imagem em destaque
            </span>
            <label htmlFor="imagemEmDestaque" className={classNames('w-full rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold',
                { 'h-72 bg-aurora': !preview }
            )}>
                {preview ? (
                    <img src={preview} alt="Imagem em destaque" className="w-full h-auto bg-aurora rounded-md object-cover" />
                ) : (
                    "+"
                )}
            </label>
            <input 
                {...register("imagem_em_destaque")}
                type="file" 
                id="imagemEmDestaque" 
                className="hidden" 
                onChange={(e)=>{converter(e, setValue, "imagem_em_destaque")}} 
            />
        </>
    );
}