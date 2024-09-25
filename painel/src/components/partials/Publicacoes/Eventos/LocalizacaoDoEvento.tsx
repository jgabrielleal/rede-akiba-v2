import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useEvento } from "@/services/eventos/queries";

import LocalizacaoDoEventoPlaceholder from "@/components/skeletons/Publicacoes/LocalizacaoDoEvento/LocalizacaoDoEventoPlaceholder";

export default function LocalizacaoDoEvento() {
    const { slug } = useParams();
    const { data: evento, isLoading } = useEvento(slug ?? "");

    const [isLocal, setIsLocal] = useState<string>("");
    const [isDatas, setIsDatas] = useState<string>("");

    useEffect(() => {
        setIsLocal(evento?.local || "");
        setIsDatas(evento?.datas || "");
    }, [evento]);

    useEffect(()=>{
        setIsLocal("");
        setIsDatas("");
    }, [slug])

    if (isLoading) {
        return <LocalizacaoDoEventoPlaceholder />;
    }

    return (
        <section className="w-[70rem] flex gap-5 lg:gap-10 justify-between flex-wrap lg:flex-nowrap">
            <div className="w-full">
                <div className="flex justify-between items-center gap-2 mb-3 mt-1">
                    <label htmlFor="local" className="font-averta text-laranja-claro text-center uppercase">
                        Local
                    </label>
                    <input
                        type="text"
                        id="local"
                        name="local"
                        className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora"
                        value={isLocal}
                        onChange={(e) => setIsLocal(e.target.value)}
                    />
                </div>
            </div>
            <div className="w-full">
                <div className="flex justify-between items-center gap-2 mb-3 mt-1">
                    <label htmlFor="datas" className="font-averta text-laranja-claro text-center uppercase">
                        Datas
                    </label>
                    <input
                        type="text"
                        id="datas"
                        name="datas"
                        className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora"
                        value={isDatas}
                        onChange={(e) => setIsDatas(e.target.value)}
                    />
                </div>
            </div>
        </section>
    )
}