export default function FraseDoPrograma() {
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <label htmlFor="locutor" className="font-averta font-bold text-laranja-claro text-lg uppercase block mb-1">
                Qual a frase para este programa?
            </label>
            <input type="text" id="locutor" className="w-full outline-none bg-aurora rounded-md px-2 py-2" />
        </section>
    )
}