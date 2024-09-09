export default function ImagemEmDestaque() {
    return (
        <>
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Imagem em destaque
            </span>
            <label htmlFor="imagemEmDestaque" className="w-full h-72 bg-aurora rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold">
                +
            </label>
            <input type="file" id="imagemEmDestaque" className="hidden" />
        </>
    )
}