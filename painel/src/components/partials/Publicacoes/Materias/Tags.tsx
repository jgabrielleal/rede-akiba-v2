import { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import { useMateria } from "@/services/materias/queries";

import TagsPlaceholder from "@/components/skeletons/Publicacoes/Tags/TagsPlaceholder";

export default function Tags({ register, setValue }: any) {
    const { slug } = useParams();
    const { data: materia, isLoading } = useMateria(slug ?? "");

    const [isPrimeiraTag, setIsPrimeiraTag] = useState<string>("");
    const [isSegundaTag, setSegundaTag] = useState<string>("");

    useEffect(() => {
        if(slug && materia) {
            setValue("primeiraTag", materia.tags?.[0] ?? "");
            setValue("segundaTag", materia.tags?.[1] ?? "");
            
            setIsPrimeiraTag(materia.tags?.[0] ?? "");
            setSegundaTag(materia.tags?.[1] ?? "");
        }
    }, [slug, materia]);

    if (isLoading) {
        return <TagsPlaceholder />;
    }

    return (
        <section className="w-[70rem] flex gap-5 lg:gap-10 justify-between flex-wrap lg:flex-nowrap">
            <div className="w-full">
                <label htmlFor="primeiraTag" className="mb-1 block font-averta font-bold text-lg text-azul-claro uppercase text-center">
                    Primeira Tag
                </label>
                <select
                    {...register("primeiraTag", { required: "O campo primeira tag é obrigatório" })}
                    id="primeiraTag"
                    name="primeiraTag"
                    className="h-10 w-full bg-aurora rounded-md outline-none px-2"
                    value={isPrimeiraTag}
                    onChange={(event) => { setIsPrimeiraTag(event.target.value) }}
                >
                    <option value="">Selecione uma tag</option>
                    <option value="animes">Animes</option>
                    <option value="mangas">Mangás</option>
                    <option value="tops">Top's</option>
                    <option value="primeiras-impressoes">Primeiras impressões</option>
                    <option value="eventos">Eventos</option>
                    <option value="listas">Listas</option>
                    <option value="curiosidades">Curiosidade</option>
                </select>
            </div>
            <div className="w-full">
                <label htmlFor="segundaTag" className="mb-1 block font-averta font-bold text-lg text-azul-claro uppercase text-center">
                    Segunda Tag
                </label>
                <select
                    {...register("segundaTag", { required: "O campo segunda tag é obrigatório" })}
                    id="segundaTag"
                    name="segundaTag"
                    className="h-10 w-full bg-aurora rounded-md outline-none px-2"
                    value={isSegundaTag}
                    onChange={(event) => { setSegundaTag(event.target.value) }}
                >
                    <option value="">Selecione uma tag</option>
                    <option value="animes">Animes</option>
                    <option value="mangas">Mangás</option>
                    <option value="tops">Top's</option>
                    <option value="primeiras-impressoes">Primeiras impressões</option>
                    <option value="eventos">Eventos</option>
                    <option value="listas">Listas</option>
                    <option value="curiosidades">Curiosidade</option>
                </select>
            </div>
        </section>
    );
}