import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import classNames from 'classnames';
import { useImagePreview } from "@/hooks/useImagePreview";
import { useMateria } from "@/services/materias/queries";

import ImagemEmDestaquePlaceholder from "@/components/skeletons/Publicacoes/ImagemEmDestaque/ImagemEmDestaquePlaceholder";

export default function ImagemEmDestaque({register, setValue} : any) {
    const { slug } = useParams();
    const { data: materia, isLoading } = useMateria(slug ?? "");
    const { data: previewDeImagem } = useImagePreview();

    const [imagemPreview, setImagemPreview] = useState<string | null>(null);

    useEffect(() => {
        setImagemPreview(materia?.imagem_em_destaque || null);
    }, [materia]);

    const handleImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        if (file) {
            previewDeImagem(e, setImagemPreview);
            setValue('imagem_em_destaque', file); // Atualiza o valor do campo no formulário
        }
    };

    if (isLoading) {
        return <ImagemEmDestaquePlaceholder />;
    }

    return (
        <>
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Imagem em destaque
            </span>
            <label htmlFor="imagemEmDestaque" className={classNames('w-full rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold',
                { 'h-72 bg-aurora': !imagemPreview }
            )}>
                {imagemPreview ? (
                    <img src={imagemPreview} alt="Imagem em destaque" className="w-full h-auto bg-aurora rounded-md object-cover" />
                ) : (
                    "+"
                )}
            </label>
            <input 
                {...register('imagem_em_destaque')}
                type="file" 
                id="imagemEmDestaque" 
                className="hidden" 
                onChange={handleImageChange} 
            />
        </>
    );
}