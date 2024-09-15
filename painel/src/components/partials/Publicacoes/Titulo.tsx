import TituloPlaceholder from "@/components/skeletons/Publicacoes/Titulo/TituloPlaceholder";

export default function Titulo(){
    return(
        <section className="w-full mb-3">
            <label htmlFor="titulo" className="font-averta font-bold text-laranja-claro text-lg uppercase block mb-1">
                Titulo
            </label>
            <input type="text" name="titulo" id="titulo" className="w-full bg-aurora outline-none rounded-md font-averta p-2" />
        </section>
    )
}