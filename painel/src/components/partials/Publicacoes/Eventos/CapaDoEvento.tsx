import { useEffect } from 'react';
import { useParams } from 'react-router-dom';
import classNames from 'classnames';
import { useImagePreview } from "@/hooks/useImagePreview";
import { useEvento } from "@/services/eventos/queries";

import CapaDaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/CapaDaPublicacao/CapaDaPublicacaoPlaceholder";

export default function capaDoEvento({register, setValue} : any) {
    const { slug } = useParams();
    const { data: evento, isLoading } = useEvento(slug ?? "");
    const { converter, preview, setPreview } = useImagePreview();

    useEffect(() => {
        if (slug && evento) {
            setValue('capa_do_evento', evento.capa_do_evento ?? null);
            setPreview(evento.capa_do_evento ?? null);
        }
    }, [slug, evento]);

    if (isLoading) {
        return <CapaDaPublicacaoPlaceholder />;
    }

    return (
        <section className="mb-3">
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Capa do evento
            </span>
            <label htmlFor="capaDoEvento" className={classNames('w-full rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold',
                { 'h-72 bg-aurora': !preview }
            )}>                
            {preview ? (
                    <img src={preview} alt="Capa do evento" className="w-full h-72 bg-aurora rounded-md object-cover" />
                ) : (
                    "+"
                )}
            </label>
            <input
                {...register("capa_do_evento")}
                type="file"
                id="capaDoEvento"
                className="hidden"
                onChange={(e) => { converter(e, setValue, 'capa_do_evento') }}
            />
        </section>
    );
}