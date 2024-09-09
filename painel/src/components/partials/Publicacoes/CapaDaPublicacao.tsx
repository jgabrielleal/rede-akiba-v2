export default function CapaDaPublicacao() {
    return (
        <section className="mb-3">
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Capa da matéria
            </span>
            <label htmlFor="CapaDaPublicacao" className="w-full h-64 bg-aurora rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold">
                +
            </label>
            <input type="file" id="CapaDaPublicacao" className="hidden" />
        </section>
    )
}