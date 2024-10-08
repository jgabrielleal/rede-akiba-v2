import { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import { useMateria } from "@/services/materias/queries";

import FontesDePesquisaPlaceholder from "@/components/skeletons/Publicacoes/FontesDePesquisa/FontesDePesquisaPlaceholder";

export default function FontesDePesquisa({ register, setValue }: any) {
    const { slug } = useParams();
    const { data: materia, isLoading } = useMateria(slug ?? "");

    const [isNomePrimeiraFonteDePesquisa, setIsNomePrimeiraFonteDePesquisa] = useState<string | null>();
    const [isLinkPrimeiraFonteDePesquisa, setIsLinkPrimeiraFonteDePesquisa] = useState<string | null>();
    const [isNomeSegundaFonteDePesquisa, setIsNomeSegundaFonteDePesquisa] = useState<string | null>();
    const [isLinkSegundaFonteDePesquisa, setIsLinkSegundaFonteDePesquisa] = useState<string | null>();

    useEffect(() => {
        if (slug && materia && materia.fontes_de_pesquisa) {
            setIsNomePrimeiraFonteDePesquisa(materia.fontes_de_pesquisa[0].site ?? "");
            setIsLinkPrimeiraFonteDePesquisa(materia.fontes_de_pesquisa[0].link ?? "");
            setIsNomeSegundaFonteDePesquisa(materia.fontes_de_pesquisa[1].site ?? "");
            setIsLinkSegundaFonteDePesquisa(materia.fontes_de_pesquisa[1].link ?? "");

            setValue("primeiraFonteDePesquisaNome", materia.fontes_de_pesquisa[0].site ?? "");
            setValue("primeiraFonteDePesquisaLink", materia.fontes_de_pesquisa[0].link ?? "");
            setValue("segundaFonteDePesquisaNome", materia.fontes_de_pesquisa[1].site ?? "");
            setValue("segundaFonteDePesquisaLink", materia.fontes_de_pesquisa[1].link ?? "");
        }
    }, [slug, materia]);

    if (isLoading) {
        return <FontesDePesquisaPlaceholder />
    }

    return (
        <section className="w-[70rem] flex gap-5 lg:gap-10 justify-between flex-wrap lg:flex-nowrap">
            <div className="w-full">
                <span className="block font-averta font-bold text-laranja-claro text-center italic uppercase">
                    Primeira fonte de pesquisa
                </span>
                <div className="flex justify-between items-center gap-2 mb-3 mt-1">
                    <label htmlFor="primeiraFonteDePesquisaNome" className="font-averta text-laranja-claro text-center uppercase">
                        Nome
                    </label>
                    <input
                        {...register("primeiraFonteDePesquisaNome", { required: "O campo nome da primeira fonte de pesquisa é obrigatório" })}
                        type="text"
                        id="primeiraFonteDePesquisaNome"
                        name="primeiraFonteDePesquisaNome"
                        className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora"
                        value={isNomePrimeiraFonteDePesquisa ?? ""}
                        onChange={(e) => setIsNomePrimeiraFonteDePesquisa(e.target.value)}
                    />
                </div>
                <div className="flex justify-between items-center gap-4">
                    <label htmlFor="primeiraFonteDePesquisaLink" className="font-averta text-laranja-claro text-center uppercase">
                        Link
                    </label>
                    <input
                        {...register("primeiraFonteDePesquisaLink", { required: "O campo link da primeira fonte de pesquisa é obrigatório" })}
                        type="text"
                        id="primeiraFonteDePesquisaLink"
                        name="primeiraFonteDePesquisaLink"
                        className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora"
                        value={isLinkPrimeiraFonteDePesquisa ?? ""}
                        onChange={(e) => setIsLinkPrimeiraFonteDePesquisa(e.target.value)}
                    />
                </div>
            </div>
            <div className="w-full">
                <span className="block font-averta font-bold text-laranja-claro text-center italic uppercase">
                    Segunda fonte de pesquisa
                </span>
                <div className="flex justify-between items-center gap-2 mb-3 mt-1">
                    <label htmlFor="segundaFonteDePesquisaNome" className="font-averta text-laranja-claro text-center uppercase">
                        Nome
                    </label>
                    <input
                        {...register("segundaFonteDePesquisaNome", { required: "O campo nome da segunda fonte de pesquisa é obrigatório" })}
                        type="text"
                        id="segundaFonteDePesquisaNome"
                        name="segundaFonteDePesquisaNome"
                        className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora"
                        value={isNomeSegundaFonteDePesquisa ?? ""}
                        onChange={(e) => setIsNomeSegundaFonteDePesquisa(e.target.value)}
                    />
                </div>
                <div className="flex justify-between items-center gap-4">
                    <label htmlFor="segundaFonteDePesquisaLink" className="font-averta text-laranja-claro text-center uppercase">
                        Link
                    </label>
                    <input
                        {...register("segundaFonteDePesquisaLink", { required: "O campo link da segunda fonte de pesquisa é obrigatório" })}
                        type="text"
                        id="segundaFonteDePesquisaLink"
                        name="segundaFonteDePesquisaLink"
                        className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora"
                        value={isLinkSegundaFonteDePesquisa ?? ""}
                        onChange={(e) => setIsLinkSegundaFonteDePesquisa(e.target.value)}
                    />
                </div>
            </div>
        </section>
    )
}
