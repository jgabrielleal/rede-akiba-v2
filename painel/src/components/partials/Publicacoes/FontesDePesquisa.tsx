import { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import { useQueryClient } from "@tanstack/react-query";
import { useMateria } from "@/services/materias/queries";
import FontesDePesquisaPlaceholder from "@/components/skeletons/Publicacoes/FontesDePesquisa/FontesDePesquisaPlaceholder";

export default function FontesDePesquisa() {
    const { slug } = useParams();

    const queryClient = useQueryClient();
    const { data: materia, isLoading: materiaLoading } = useMateria(slug ?? "");

    const [isPrimeiroNome, setIsPrimeiroNome] = useState<string>("");
    const [isPrimeiroLink, setIsPrimeiroLink] = useState<string>("");
    const [isSegundoNome, setIsSegundoNome] = useState<string>("");
    const [isSegundoLink, setIsSegundoLink] = useState<string>("");

    useEffect(() => {
        if (materia?.fontes_de_pesquisa && materia.fontes_de_pesquisa.length > 0) {
            setIsPrimeiroNome(materia.fontes_de_pesquisa[0]?.site || "");
            setIsPrimeiroLink(materia.fontes_de_pesquisa[0]?.link || "");
            if (materia.fontes_de_pesquisa.length > 1) {
                setIsSegundoNome(materia.fontes_de_pesquisa[1]?.site || "");
                setIsSegundoLink(materia.fontes_de_pesquisa[1]?.link || "");
            }
        } else {
            setIsPrimeiroNome("");
            setIsPrimeiroLink("");
            setIsSegundoNome("");
            setIsSegundoLink("");
        }
    }, [slug, materia]);
    
    useEffect(()=>{
        queryClient.invalidateQueries({queryKey: ["Materias"]});
        queryClient.invalidateQueries({queryKey: ["MateriasInfinite"]});   
    }, [slug]);

    if(materiaLoading){
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
                        type="text" 
                        id="primeiraFonteDePesquisaNome" 
                        name="primeiraFonteDePesquisaNome" 
                        className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora" 
                        value={isPrimeiroNome}
                        onChange={(event)=>{setIsPrimeiroNome(event.target.value)}}
                    />
                </div>
                <div className="flex justify-between items-center gap-4">
                    <label htmlFor="primeiraFonteDePesquisaLink" className="font-averta text-laranja-claro text-center uppercase">
                        Link
                    </label>
                    <input 
                        type="text" 
                        id="primeiraFonteDePesquisaLink" 
                        name="primeiraFonteDePesquisaLink" 
                        className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora" 
                        value={isPrimeiroLink}
                        onChange={(event)=>{setIsPrimeiroLink(event.target.value)}}
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
                        type="text" 
                        id="segundaFonteDePesquisaNome" 
                        name="segundaFonteDePesquisaNome" 
                        className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora" 
                        value={isSegundoNome}
                        onChange={(event)=>{setIsSegundoNome(event.target.value)}}
                    />
                </div>
                <div className="flex justify-between items-center gap-4">
                    <label htmlFor="segundaFonteDePesquisaLink" className="font-averta text-laranja-claro text-center uppercase">
                        Link
                    </label>
                    <input 
                        type="text" 
                        id="segundaFonteDePesquisaLink" 
                        name="segundaFonteDePesquisaLink" 
                        className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora" 
                        value={isSegundoLink}
                        onChange={(event)=>{setIsSegundoLink(event.target.value)}}
                    />
                </div>
            </div>
        </section>
    )
}