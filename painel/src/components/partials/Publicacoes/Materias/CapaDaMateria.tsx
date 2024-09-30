import { useEffect } from 'react';
import { useParams } from 'react-router-dom';
import classNames from 'classnames';
import { useImagePreview } from "@/hooks/useImagePreview";
import { useMateria } from "@/services/materias/queries";

import CapaDaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/CapaDaPublicacao/CapaDaPublicacaoPlaceholder";

export default function CapaDaMateria({register, setValue} : any) {
    const { slug } = useParams();
    const { data: materia, isLoading } = useMateria(slug ?? "");
    const { converter, preview, setPreview } = useImagePreview();

    useEffect(() => {
        if (slug && materia) {
            setValue('capa_da_materia', materia.capa_da_materia ?? null);
            setPreview(materia.capa_da_materia ?? null);
        }
    }, [slug, materia]);

    if (isLoading) {
        return <CapaDaPublicacaoPlaceholder />;
    }

    return (
        <section className="mb-3">
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Capa da matéria
            </span>
            <label htmlFor="capaDaMateria" className={classNames('w-full rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold',
                { 'h-72 bg-aurora': !preview }
            )}>                
            {preview ? (
                    <img src={preview} alt="Capa da matéria" className="w-full h-72 bg-aurora rounded-md object-cover" />
                ) : (
                    "+"
                )}
            </label>
            <input
                {...register("capa_da_materia")}
                type="file"
                id="capaDaMateria"
                className="hidden"
                onChange={(e) => { converter(e, setValue, 'capa_da_materia') }}
            />
        </section>
    );
}