export default function CapaDaMateria() {
    return (
        <>
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Capa da matéria
            </span>
            <label htmlFor="capaDaMateria" className="w-full h-64 bg-aurora rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold">
                +
            </label>
            <input type="file" id="capaDaMateria" className="hidden" />
        </>
    )
}