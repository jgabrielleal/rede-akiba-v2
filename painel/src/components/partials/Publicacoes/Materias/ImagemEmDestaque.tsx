import { useEffect } from 'react';
import { useParams } from 'react-router-dom';
import classNames from 'classnames';
import { useImagePreview } from "@/hooks/useImagePreview";
import { useMateria } from "@/services/materias/queries";

import ImagemEmDestaquePlaceholder from "@/components/skeletons/Publicacoes/ImagemEmDestaque/ImagemEmDestaquePlaceholder";

export default function ImagemEmDestaque({register, setValue} : any) {
    const { slug } = useParams();
    const { data: materia, isLoading } = useMateria(slug ?? "");
    const { converter, preview, setPreview } = useImagePreview();

    useEffect(() => {
        if (slug && materia) {
            setValue('imagem_em_destaque', materia.imagem_em_destaque ?? null);
            setPreview(materia.imagem_em_destaque ?? null);
        }
    }, [slug, materia]);

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