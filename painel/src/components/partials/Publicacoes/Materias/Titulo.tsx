import { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import { useMateria } from "@/services/materias/queries";

import TituloPlaceholder from "@/components/skeletons/Publicacoes/Titulo/TituloPlaceholder";

export default function Titulo({ register }: any) {
    const { slug } = useParams();
    const { data: materia, isLoading } = useMateria(slug ?? "");

    const [isTitulo, setTitulo] = useState<string | null>();

    useEffect(() => {
        setTitulo(materia?.titulo || "");
    }, [materia]);

    useEffect(()=>{
        setTitulo("");
    }, [slug])

    if (isLoading) {
        return <TituloPlaceholder />;
    }

    return (
        <section className="w-full mb-3">
            <label htmlFor="titulo" className="font-averta font-bold text-laranja-claro text-lg uppercase block mb-1">
                Titulo
            </label>
            <input
                {...register("titulo", { required: "O campo título é obrigatório" })}
                type="text"
                name="titulo"
                id="titulo"
                className="w-full bg-aurora outline-none rounded-md font-averta p-2"
                value={isTitulo ?? ""}
                onChange={(e) => setTitulo(e.target.value)}
            />
        </section>
    );
}